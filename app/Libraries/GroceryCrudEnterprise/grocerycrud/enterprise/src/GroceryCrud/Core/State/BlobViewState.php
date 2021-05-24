<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\Exceptions\Exception;
use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Exceptions\Exception as GCrudException;
use GroceryCrud\Core\Exceptions\PermissionDeniedException;

class BlobViewState extends StateAbstract {

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
        return (object)array(
            'primaryKeyValue' => !empty($_GET['pk_value']) ? $_GET['pk_value'] : null,
            'fieldName' => !empty($_GET['field_name']) ? $_GET['field_name'] : null
        );
    }

    public function initialize($stateParameters)
    {
        $this->setModel();
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }

        $model->setPrimaryKey($this->getPrimaryKeyName());
        $model->setRelations1ToN($this->getRelations1ToN());
    }

    public function setCallbackFields($outputData) {
        $callbackEditFields = $this->gCrud->getCallbackEditFields();

        foreach ($callbackEditFields as $fieldName => $callback) {

            $outputData[$fieldName] =
                array_key_exists($fieldName, $outputData)
                    ? $callback($outputData[$fieldName], $this->getStateParameters()->primaryKeyValue, $outputData)
                    : '';
        }

        return $outputData;
    }

    public function render()
    {
        if (!$this->gCrud->getLoadEdit() && !$this->gCrud->getLoadRead() && !$this->gCrud->getLoadAdd()) {
            throw new PermissionDeniedException('Permission denied. You are not allowed to use this operation');
        }

        $stateParameters = $this->getStateParameters();

        if ($stateParameters->fieldName === null) {
            throw new GCrudException('Wrong input data');
        }

        $this->initialize($stateParameters);

        $model = $this->gCrud->getModel();
        $fieldTypes = $this->getFieldTypes();

        $output = (object)[];

        try {
            $primaryKeyValue = $stateParameters->primaryKeyValue;

            if (!$model->validateOne($primaryKeyValue)) {
                throw new GCrudException(
                    "Either the user doesn't have access to this row, either the row doesn't exist."
                );
            }

            $outputData = $model->getOne($primaryKeyValue);

            $fieldName = $stateParameters->fieldName;

            if (
                array_key_exists($fieldName, $outputData) &&
                array_key_exists($fieldName, $fieldTypes) &&
                $fieldTypes[$fieldName]->dataType === GroceryCrud::FIELD_TYPE_BLOB
            ) {

                $filenameField = $fieldTypes[$fieldName]->options->filenameField;

                if (empty($outputData[$fieldName]) || empty($outputData[$filenameField])) {
                    throw new GCrudException(
                        "No data to display"
                    );
                }

                $filename = $outputData[$filenameField];

                header('Content-Disposition: Attachment; filename="' . $filename . '"');

                echo $outputData[$stateParameters->fieldName];
                die;
            } else {
                throw new GCrudException(
                    "Can't find field_name data for:" . $stateParameters->fieldName
                );
            }

            $outputData = $this->enhanceFormOutputData($outputData, $primaryKeyValue);

            $editFormCallback = $this->gCrud->getCallbackEditForm();

            if ($editFormCallback !== null) {
                $outputData = $editFormCallback($outputData);
            }

            $outputData = $this->setCallbackFields($outputData);

            $output = $this->setResponseStatusAndMessage($output, $outputData);

            if ($output->status === 'success') {
                $output->data = $outputData;
            }

        } catch (GCrudException $e) {
            $output->message = $e->getMessage();
            $output->status = 'failure';
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }
}