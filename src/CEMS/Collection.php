<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 02/07/2014
 * Time: 13:32
 */

namespace CEMS;

/**
 * Class Collection
 * @package CEMS
 */
class Collection
{
    /**
     * @var array
     */
    protected $collection = array();

    /**
     * @param        $raw_response
     * @param string $type
     */
    function __construct($raw_response, $type = 'CEMS\Resource')
    {
        $this->collection = array();

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
     * @return array
     */
    public function toArray()
    {
        return $this->collection;
    }
} 