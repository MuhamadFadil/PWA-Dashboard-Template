<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Error\ErrorMessageInteface;

class InsertState extends StateAbstract {

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
            'data' => $data['data']
        );
    }

    public function render()
    {
        if (!$this->gCrud->getLoadAdd()) {
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

        $validator = $this->getValidationRules();

        $output = (object)array();

        if (!$validator->validate()) {
            $output->status = 'error';
            $output->errors = $validator->getErrors();
        } else {

            $fieldTypes = $this->getFieldTypes(false);

            foreach ($stateParameters->data as $field_name => $field_value) {
                if ($field_value === '' && !empty($fieldTypes->$field_name) && $fieldTypes->$field_name->isNullable) {
                    $stateParameters->data[$field_name] = null;
                }
            }

            $addFields = $this->getAddFields();
            $readOnlyAddFields = $this->gCrud->getReadOnlyAddFields();

            $relationNtoNData = $this->getRelationNtoNData($addFields, $stateParameters->data);
            $stateParameters->data = $this->formatInputData(
                $this->getFilteredData($addFields, $stateParameters->data, $readOnlyAddFields)
            );

            $uploadedData = $this->uploadDataIfRequired($fieldTypes);
            if (!empty($uploadedData)) {
                $stateParameters->data = $this->addUploadData($stateParameters->data, $uploadedData);
            }

            $operationResponse = $this->stateOperationWithCallbacks($stateParameters, 'Insert', function ($stateParameters) use ($relationNtoNData) {
                $model = $this->gCrud->getModel();
                $insertResult = $model->insert($stateParameters->data);
// echo 'insertResult:'; print_r($insertResult);die();
                $stateParameters->insertId = $insertResult->insertId;

                $relationNtoNfields = $this->gCrud->getRelationNtoN();

                foreach ($relationNtoNData as $fieldName => $relationData) {
                    $model->insertRelationManytoMany($relationNtoNfields[$fieldName], $relationData, $stateParameters->insertId);
                }
// echo '(IS1)';
// print_r($stateParameters->insertId); //ok
                return $stateParameters;
            });
						
// echo '(IS2)';
// print_r($operationResponse);die();

            $output = $this->setResponseStatusAndMessage($output, $operationResponse);

            if ($operationResponse !== false && !($operationResponse instanceof ErrorMessageInteface)) {
// print_r($operationResponse->insertId);die();
                $output->insertId = $operationResponse->insertId;
// print_r($output->insertId);
            }
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }
}