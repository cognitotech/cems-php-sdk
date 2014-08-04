<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 02/07/2014
 * Time: 13:32
 */

namespace CEMS;

/**
 * Class Collection contains array of items from response data.
 * @package CEMS
 */
class Collection
{
    /**
     * Collection data
     * 
     * @var array
     */
    protected $collection = array();

    /**
     * Collection Constructor
     *
     * If there is no entry return from response data, it will return an empty collection.
     *
     * @param        $raw_response
     * @param string $type
     */
    function __construct($raw_response, $type = 'CEMS\Resource')
    {
        $this->collection = array();
        if ($raw_response['total_entries'] == 0)
            return;
        $class = ucwords($type);
        if (class_exists($class)) {
            foreach ($raw_response['collection'] as $item) {
                $object = new $class($item);
                array_push($this->collection, $object);
            }
        }
        //TODO: save page num, current page to this class
    }

    /**
     * Get collection data
     * @return array
     */
    public function toArray()
    {
        return $this->collection;
    }
} 