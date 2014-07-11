<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 05/07/2014
 * Time: 12:51
 */

namespace CEMS;

/**
 * Class Generic Error
 * @package CEMS
 */
class Error extends BaseException{
    /**
     * @return string
     */
    public function __toString() {

        $dump=$this->varDumpToString($this->_message);
        return get_class($this). ":[{$this->_code}]: {$dump}\n";
    }

    /**
     * Helper for export var_dump object to string
     * @param $var
     * @return string
     */
    public function varDumpToString ($var)
    {
        ob_start();
        var_dump($var);
        return ob_get_clean();
    }
} 