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
 * @property access_token; //TODO: move to concrete class: AuthorizationResponse
 * @package CEMS
 */
class Response
{
    /**
     * @var $response contain raw data in JSON format
     */
    protected $response = array();

    /**
     * @param $JSON_data
     */
    function __construct($JSON_data)
    {
        $this->response = $JSON_data;
    }

    /**
     * @param string $type
     *
     * @return Collection
     */
    public function getObjectList($type = 'CEMS\Resource')
    {
        return new Collection($this->response, $type);
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
            $object = new $class($this->response);
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
        if (array_key_exists($key, $this->response)) {
            return $this->response[$key];
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
        return isset($this->response[$key]);
    }
}