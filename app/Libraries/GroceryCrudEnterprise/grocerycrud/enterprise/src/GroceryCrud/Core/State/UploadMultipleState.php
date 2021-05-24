<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\Exceptions\Exception;
use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Error\ErrorMessage;

class UploadMultipleState extends StateAbstract {

    public function getStateParameters()
    {
        return (object)[
            'field_name' => array_keys($_FILES)[0]
        ];
    }

    public function render()
    {
        $stateParameters = $this->getStateParameters();

        $this->setModel();
        $model = $this->gCrud->getModel();

        if ($this->gCrud->getDbTableName() !== null) {
            $model->setTableName($this->gCrud->getDbTableName());
        }

        $response = $this->stateOperationWithCallbacks($stateParameters, 'Upload', function ($stateParameters) {
            $field_name = $stateParameters->field_name;
            $field_types = $this->getFieldTypes();

            if (isset($field_types[$field_name]) && $field_types[$field_name]->dataType === 'upload') {
                $response = $this->upload($field_name, $field_types[$field_name]->options->uploadPath);

                $response->filePath = $field_types[$field_name]->options->publicPath . '/' . $response->filename;
            } else {
                $response = (new ErrorMessage())->setMessage('This operation is not allowed');
            }

            return $response;
        });

        $output = (object)array();
        $output = $this->setResponseStatusAndMessage($output, $response);

        if (!$this->hasErrorResponse($response)) {
            $output->uploadResult = $response;
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }
}