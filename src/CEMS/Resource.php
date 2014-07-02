<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:55
 */

namespace CEMS;

/**
 * Class Resource
 * @package CEMS
 */
class Resource
{
    /**
     * @var array
     */
    protected $_data = array();

    function __construct($json_object)
    {
        $this->_data = $json_object;
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
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * @param $key
     * @return value
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->_data)) {
            return $this->_data[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }
} 