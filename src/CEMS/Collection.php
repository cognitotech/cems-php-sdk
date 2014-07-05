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
    protected $_collection = array();

    /**
     * @param        $RAW_response
     * @param string $type
     */
    function __construct($RAW_response, $type = 'CEMS\Resource')
    {
        $this->_collection = array();

        $class = ucwords($type);
        if (class_exists($class)) {
            foreach ($RAW_response['collection'] as $item) {
                $object = new $class($item);
                array_push($this->_collection, $object);
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_collection;
    }
} 