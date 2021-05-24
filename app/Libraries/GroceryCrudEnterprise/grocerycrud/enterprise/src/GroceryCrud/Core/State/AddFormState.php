<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Model;

class AddFormState extends StateAbstract {

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

        );
    }

    public function initialize()
    {
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }
    }

    public function render()
    {
        if (!$this->gCrud->getLoadAdd()) {
            throw new \Exception('Permission denied. You are not allowed to use this operation');
        }

        $this->setModel();
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }

        $this->initialize();

        $result = $this->getAddFormFields();

        $addFormCallback = $this->gCrud->getCallbackAddForm();

        $output = (object)[];

        if ($addFormCallback !== null) {
            $result = $addFormCallback($result);
        }

        $output = $this->setResponseStatusAndMessage($output, $result);

        if ($output->status === 'success') {
            $output->data = $result;
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }

    public function getAddFormFields() {
        $model = $this->gCrud->getModel();
        $addFormFields = $this->gCrud->getAddFields();
        $multipleSelectFields = $this->getMultiselectFields();


        if (empty($addFormFields)) {
            $addFormFields = $this->removePrimaryKeyFromList($model->getColumnNames());
        }

        $formFieldsList = [];

        foreach ($addFormFields as $fieldName) {
            $formFieldsList[$fieldName] = '';
        }

        foreach ($multipleSelectFields as $fieldName) {
            if (isset($formFieldsList[$fieldName])) {
                $formFieldsList[$fieldName] = null;
            }
        }

        return $formFieldsList;
    }

    public function _getCommonData()
    {
        $data = (object)array();

        $data->subject 				= $this->gCrud->getSubject();
        $data->subject_plural 		= $this->gCrud->getSubjectPlural();

        return $data;
    }
}