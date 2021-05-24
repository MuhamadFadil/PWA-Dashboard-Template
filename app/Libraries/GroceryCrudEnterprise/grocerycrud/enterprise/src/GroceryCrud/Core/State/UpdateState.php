<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Exceptions\Exception as GCrudException;

class UpdateState extends StateAbstract {

    /**
     * MainState constructor.
     * @param GCrud $gCrud
     */
    function __construct(GCrud $gCrud)
    {
        $this->gCrud = $gCrud;
    }

    public function getStateParameters()
    {
        $data = $_POST;

        $data['data'] = $this->filterData($data['data']);

        return (object)array(
            'primaryKeyValue' => $data['pk_value'],
            'data' => $data['data']
        );
    }

    public function render()
    {
        if (!$this->gCrud->getLoadEdit()) {
            throw new \Exception('Permission denied. You are not allowed to use this operation');
        }

        $stateParameters = $this->getStateParameters();

        $this->setModel();
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }

        $this->setColumns();

        $validator = $this->getValidationRules();

        $output = (object)array();

        if (!$validator->validate()) {
            $output->status = 'error';
            $output->errors = $validator->getErrors();
        } else {
            try {
                $model->setPrimaryKey($this->getPrimaryKeyName());
                $model->setRelations1ToN($this->getRelations1ToN());

                if (!$model->validateOne($stateParameters->primaryKeyValue)) {
                    throw new GCrudException(
                        "Either the user doesn't have access to this row, either the row doesn't exist."
                    );
                }

                $fieldTypes = $this->getFieldTypes();
                $readOnlyEditFields = $this->gCrud->getReadOnlyEditFields();

                foreach ($stateParameters->data as $field_name => $field_value) {
                    if ($field_value === '' && !empty($fieldTypes->$field_name) && $fieldTypes->$field_name->isNullable) {
                        $stateParameters->data[$field_name] = null;
                    }
                }

                $editFields = $this->getEditFields();
                $relationNtoNData = $this->getRelationNtoNData($editFields, $stateParameters->data);
                $stateParameters->data = $this->formatInputData(
                    $this->getFilteredData($editFields, $stateParameters->data, $readOnlyEditFields)
                );

                $uploadedData = $this->uploadDataIfRequired($fieldTypes);
                if (!empty($uploadedData)) {
                    $stateParameters->data = $this->addUploadData($stateParameters->data, $uploadedData);
                }

                $callbackResult = $this->stateOperationWithCallbacks($stateParameters, 'Update', function ($stateParameters) use ($relationNtoNData) {
                    $model = $this->gCrud->getModel();
                    $relationNtoNfields = $this->gCrud->getRelationNtoN();
                    $model->update($stateParameters->primaryKeyValue, $stateParameters->data);

                    foreach ($relationNtoNData as $fieldName => $relationData) {
                        $model->updateRelationManytoMany($relationNtoNfields[$fieldName], $relationData, $stateParameters->primaryKeyValue);
                    }

                    return $stateParameters;
                });

                $output = $this->setResponseStatusAndMessage($output, $callbackResult);

            } catch (GCrudException $e) {
                $output->message = $e->getMessage();
                $output->status = 'failure';
            }
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }

    public function showList($results)
    {
        $data = $this->_getCommonData();
        $columns = $this->gCrud->getColumns();

        if (!empty($columns)) {
            $data->columns = $columns;
        } else {
            $data->columns = array_keys((array)$results[0]);
        }

        return $this->gCrud->getLayout()->theme_view('list_template.php', $data, true);
    }

    public function _getCommonData()
    {
        $data = (object)array();

        $data->subject 				= $this->gCrud->getSubject();
        $data->subject_plural 		= $this->gCrud->getSubjectPlural();

        return $data;
    }
}