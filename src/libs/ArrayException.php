<?php

class ArrayException extends Exception {

    private $_options;

    public function __construct($code = 0, $options = array('params')) {
        
        parent::__construct($code);
        $this->_options = $options; 
    }

    public function getArrayMessage() { 
    	return $this->_options; 
    }
    
}