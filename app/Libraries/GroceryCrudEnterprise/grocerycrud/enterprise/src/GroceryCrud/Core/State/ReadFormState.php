<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Exceptions\Exception as GCrudException;

class ReadFormState extends StateAbstract {

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

    public function initialize()
    {
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }

        $model->setPrimaryKey($this->getPrimaryKeyName());
        $model->setRelations1ToN($this->getRelations1ToN());
    }

    public function render()
    {
        if (!$this->gCrud->getLoadRead()) {
            throw new \Exception('Permission denied. You are not allowed to use this operation');
        }

        $stateParameters = $this->getStateParameters();

        $this->setModel();
        $model = $this->gCrud->getModel();

        $this->gCrud->setTheme('Bootstrap');

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        $this->initialize();

        $model = $this->gCrud->getModel();

        $output = (object)[];

        try {
            if (!$model->validateOne($stateParameters->primaryKeyValue)) {
                throw new GCrudException(
                    "Either the user doesn't have access to this row, either the row doesn't exist."
                );
            }

            $primaryKeyValue = $stateParameters->primaryKeyValue;
            $outputData = $model->getOne($primaryKeyValue);

            $outputData = $this->mapFields($outputData);

            $outputData = $this->enhanceFormOutputData($outputData, $primaryKeyValue);

            $readFormCallback = $this->gCrud->getCallbackReadForm();

            if ($readFormCallback !== null) {
                $outputData = $readFormCallback($outputData);
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

    public function setCallbackFields($outputData) {
        $callbackEditFields = $this->gCrud->getCallbackReadFields();
				//tadinya isset di bawah ini adalah array_key_exists
        foreach ($callbackEditFields as $fieldName => $callback) {
            $outputData[$fieldName] =
                isset($fieldName, $outputData)
                    ? $callback($outputData[$fieldName], $this->getStateParameters()->primaryKeyValue, $outputData)
                    : '';
        }

        return $outputData;
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