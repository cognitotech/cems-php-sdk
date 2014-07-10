<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:57
 */

namespace CEMS;

use Exception;

/**
 * Class BaseException
 * @package CEMS
 */
class BaseException extends Exception
{
    function __construct($message=null, $code = 0, Exception $previous = null) {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     * @ignore
     */
    public function getName()
    {
        return __CLASS__;
    }

    /**
     * Custom string representation of object
     *
     * @return string
     */

    public function __toString() {
        return __CLASS__. ": [{$this->_code}]: {$this->message}\n";
    }

}