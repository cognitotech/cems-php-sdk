<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:55
 */

namespace CEMS;

/**
 * Class Resource is an abstract class contain json data parsed from Response object
 * @package CEMS
 * @property int $id Resource ID
 */
class Resource
{
    /**
     * Json Data as an associated array
     *
     * @var array
     */
    protected $data = array();

    /**
     * Constructor
     * @param array $json_object Json array
     */
    function __construct($json_object)
    {
        $this->data = $json_object;
    }

    /**
     * Get raw result as an associative array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Get an array of properties value
     * @return array
     */
    public function getPropertyAsArray()
    {
        return array_values($this->data);
    }

    /**
     * Get array of properties names
     * @return array
     */
    public function getPropertyNames()
    {
        return array_keys($this->data);
    }

    /**
     * Setter for data inside resource
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Getter for data inside resource
     *
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
     * Check whether the value correspond to the key exist inside resource
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }
} 