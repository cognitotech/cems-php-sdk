<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:06
 */

namespace CEMS;

/**
 * Class Response
 * @package CEMS
 */
class Response
{
    /**
     * @var $_response contain raw data in JSON format
     */
    protected $_response = array();

    /**
     * @param $JSON_data
     */
    function __construct($JSON_data)
    {
        $this->_response = $JSON_data;
    }

    /**
     * @param string $type
     *
     * @return Collection
     */
    public function getObjectList($type = 'CEMS\Resource')
    {
        return new Collection($this->_response, $type);
    }

    /**
     * @param string $type
     *
     * @return object
     */
    public function getObject($type = 'CEMS\Resource')
    {
        $class = ucwords($type);
        $object = null;
        if (class_exists($class)) {
            $object = new $class($this->_response);
        }

        return $object;
    }

    /**
     * @param $key
     *
     * @return value
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->_data)) {
            return $this->_response[$key];
        }

        return null;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->_response[$key]);
    }
}