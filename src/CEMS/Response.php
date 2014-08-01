<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:06
 */

namespace CEMS;

/**
 * Class Response is using for handling data result from request method of Client object
 * 
 * TODO: move to concrete class: AuthorizationResponse
 * @property string $access_token Access Token; 
 * TODO: move to concrete class: CollectionResponse
 * @property int $per_page Maximum Item Per Page
 * @property int $current_page Current Page Number
 * @property int $total_pages Total Pages Count
 * @property int $total_entries Total Entries Count
 * @property int $offset Offset
 * @property int $length Number of item in current page
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
     * Return list of item with specified class name
     * @param string $type
     *
     * @return Collection
     */
    public function getObjectList($type = 'CEMS\Resource')
    {
        return new Collection($this->response, $type);
    }

    /**
     * Return signle item with specified class name
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

    public function __get($key)
    {
        if (array_key_exists($key, $this->response)) {
            return $this->response[$key];
        }

        return null;
    }

    public function __isset($key)
    {
        return isset($this->response[$key]);
    }
}