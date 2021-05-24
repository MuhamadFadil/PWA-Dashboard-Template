<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Exceptions\Exception as GCrudException;
use GroceryCrud\Core\Exceptions\PermissionDeniedException;

class CloneFormState extends StateAbstract {

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
            'primaryKeyValue' => !empty($_GET['pk_value']) ? $_GET['pk_value'] : null
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
        $callbackCloneFields = $this->gCrud->getCallbackCloneFields();

        foreach ($callbackCloneFields as $fieldName => $callback) {

            $outputData[$fieldName] =
                array_key_exists($fieldName, $outputData)
                    ? $callback($outputData[$fieldName], $this->getStateParameters()->primaryKeyValue, $outputData)
                    : '';
        }

        return $outputData;
    }

    public function filterCloneData($data)
    {
        $blobFields = $this->gCrud->getBlobFieldNames();

        foreach ($blobFields as $fieldName) {
            if (array_key_exists($fieldName, $data)) {
                unset($data[$fieldName]);
            }
        }

        return $data;
    }

    public function render()
    {
        if (!$this->gCrud->getLoadEdit()) {
            throw new PermissionDeniedException('Permission denied. You are not allowed to use this operation');
        }

        $stateParameters = $this->getStateParameters();

        $this->initialize($stateParameters);

        $model = $this->gCrud->getModel();

        $output = (object)[];

        try {
            $primaryKeyValue = $stateParameters->primaryKeyValue;

            if (!$model->validateOne($primaryKeyValue)) {
                throw new GCrudException(
                    "Either the user doesn't have access to this row, either the row doesn't exist."
                );
            }

            $outputData = $model->getOne($primaryKeyValue);
            $outputData = $this->filterCloneData($outputData);

            $outputData = $this->mapFields($outputData);

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