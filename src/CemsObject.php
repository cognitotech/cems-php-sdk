<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:55
 */

namespace CEMS;


class CemsObject {
    /**
     * @var array
     */
    protected $_data = array();

    function __construct($json_object){
        $this->_data=$json_object;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_data;
    }

    /**
     * @return array
     */
    public function getPropertyAsArray()
    {
        #TODO: cast child object to its proper class if available
        return array_values($this->_data);
    }

    /**
     * @return array
     */
    public function getPropertyNames()
    {
        return array_keys($this->_data);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    /**
     * @param $name
     * @return value
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }

        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }
} 