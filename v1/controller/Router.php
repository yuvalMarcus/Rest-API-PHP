<?php

require_once 'Response.php';

class Router {

    private $_url;
    private $_response;
    private $_choice;

    public function __construct() {
        $url = !empty($_GET['url']) ? $_GET['url'] : '';
        $this->_url = rtrim($url, '/');
        $this->_response = new Response();
        $this->_choice = false;
    }

    public function get($url, $callback): void {

        if ($this->_choice)
            return;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if ($this->_url === $url) {

                $this->_choice = true;
                $callback($this->_response);
            }
        }
    }

    public function post($url, $callback): void {

        if ($this->_choice)
            return;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->_url === $url) {

                $this->_choice = true;
                $callback($this->_response);
            }
        }
    }

    public function end($callback): void {

        if ($this->_choice)
            return;

        $this->_choice = true;
        $callback($this->_response);
    }

}
