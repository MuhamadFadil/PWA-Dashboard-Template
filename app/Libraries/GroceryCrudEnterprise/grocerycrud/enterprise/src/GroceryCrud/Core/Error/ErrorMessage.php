<?php
namespace GroceryCrud\Core\Error;

class ErrorMessage implements ErrorMessageInteface {

    protected $_message;

    public function setMessage($message)
    {
        $this->_message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->_message;
    }
}