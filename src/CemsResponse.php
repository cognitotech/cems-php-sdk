<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:06
 */

namespace CEMS;


class CemsResponse {
    private $_response;

    function __construct($JSON_data) {
        $this->_response=$JSON_data;
    }

    public function getObjectList($type = 'CEMS\CemsObject') {

    }

    public function getObject($type = 'CEMS\CemsObject') {
        $class=ucwords($type);
        $object=NULL;
        if (class_exists($class)) {
            $object = new $class($this->_response);
        }
        return $object;
    }
}