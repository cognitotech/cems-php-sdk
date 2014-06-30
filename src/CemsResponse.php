<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:06
 */

namespace CEMS;


class CemsResponse {
    /**
     * @var $_response contain raw data in JSON format
     */
    private $_response=array();

    /**
     * @param $JSON_data
     */
    function __construct($JSON_data) {
        $this->_response=$JSON_data;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getObjectList($type = 'CEMS\CemsObject') {
        $list=array();

        $class=ucwords($type);
        if (class_exists($class)) {
            foreach ($this->_response['collection'] as $item){
                $object=new $class($item);
                array_push($list,$object);
            }
        }
        return $list;
    }

    /**
     * @param string $type
     * @return object
     */
    public function getObject($type = 'CEMS\CemsObject') {
        $class=ucwords($type);
        $object=NULL;
        if (class_exists($class)) {
            $object = new $class($this->_response);
        }
        return $object;
    }
}