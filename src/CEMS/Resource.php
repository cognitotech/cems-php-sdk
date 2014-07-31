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
 * TODO: add proper magic properties for each class
 */
class Resource
{
    /**
     * @var array
     */
    protected $data = array();

    function __construct($json_object)
    {
        $this->data = $json_object;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getPropertyAsArray()
    {
        return array_values($this->data);
    }

    /**
     * @return array
     */
    public function getPropertyNames()
    {
        return array_keys($this->data);
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed value
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
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
        return isset($this->data[$key]);
    }
} 