<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:55
 */

namespace CEMS;


class CemsObject {
    protected $_data = array();

    function __construct($json_object){
        $this->_data=$json_object;
    }

    public function toArray()
    {
        return $this->_data;
    }

    public function getPropertyAsArray()
    {
        #TODO: cast child object to its proper class if available
        return array_values($this->_data);
    }

    public function getPropertyNames()
    {
        return array_keys($this->_data);
    }

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }

        return null;
    }

    /**  As of PHP 5.1.0  */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }
} 