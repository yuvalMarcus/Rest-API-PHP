<?php

require_once 'Response.php';

class Router {

    private $_url;
    private $_response;
    private $_choice;

    public function __construct() {
        $url = $_GET['url'] ? $_GET['url'] : '';
        $this->_url = rtrim($url, '/');
        $this->_response = new Response();
        $this->_choice = false;
    }

    public function get($url, $callback) {

        if ($this->_choice)
            return;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if ($this->_url === $url) {

                $this->_choice = true;
                $callback($this->_response);
            }
        }
    }

    public function post($url, $callback) {

        if ($this->_choice)
            return;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->_url === $url) {

                $this->_choice = true;
                $callback($this->_response);
            }
        }
    }

    public function end($callback) {

        if ($this->_choice)
            return;

        $this->_choice = true;
        $callback($this->_response);
    }

}
