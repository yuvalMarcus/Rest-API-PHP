<?php

class Response {

    private $_success;
    private $_httpStatusCode;
    private $_messages = [];
    private $_data;
    private $_responseData = [];

    public function setSuccess($success): void {
        $this->_success = $success;
    }

    public function setHttpStatusCode($httpStatusCode): void {
        $this->_httpStatusCode = $httpStatusCode;
    }

    public function addMessage($messages): void {
        $this->_messages[] = $messages;
    }

    public function setData($data): void {
        $this->_data = $data;
    }

    public function send() {

        if (($this->_success !== true && $this->_success !== false) || !is_numeric($this->_httpStatusCode)) {
            http_response_code(500);
            $this->_responseData['statusCode'] = 500;
            $this->_responseData['success'] = false;
            $this->addMessage("Response creation error");
            $this->_responseData['messages'] = $this->_messages;
        } else {
            http_response_code($this->_httpStatusCode);
            $this->_responseData['statusCode'] = $this->_httpStatusCode;
            $this->_responseData['success'] = $this->_success;
            $this->_responseData['messages'] = $this->_messages;
            $this->_responseData['data'] = $this->_data;
        }
        echo json_encode($this->_responseData);
    }

}
