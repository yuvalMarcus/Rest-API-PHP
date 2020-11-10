<?php

class File {

    private $_name;
    private $_patch;

    public function __construct($name) {
        $this->_name = $name;
        $this->_patch = $_SERVER['DOCUMENT_ROOT'] . str_replace("/index.php", "", $_SERVER['URL'])  . "/model/files/";
    }

    public function write($content) {
        file_put_contents($this->_patch . $this->_name . ".txt", $content);
    }
    
    public function read() {
        return file_get_contents($this->_patch . $this->_name . ".txt");
    }
}
