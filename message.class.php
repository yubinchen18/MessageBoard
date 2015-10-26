<?php

class Message
{
    private $_name;
    private $_content;
    private $_date;
    private $_time;
    
    function __construct($name, $content, $date, $time){
        $this->_name = $name;
        $this->_content = $content;
        $this->_date = $date;
        $this->_time = $time;
    }
    
    function __destruct(){
    }
    
    function get_name() {
        return $this->_name;
    }

    function get_content() {
        return $this->_content;
    }

    function get_date() {
        return $this->_date;
    }

    function get_time() {
        return $this->_time;
    }

    function set_name($_name) {
        $this->_name = $_name;
    }

    function set_content($_content) {
        $this->_content = $_content;
    }

    function set_date($_date) {
        $this->_date = $_date;
    }

    function set_time($_time) {
        $this->_time = $_time;
    }

    
}

