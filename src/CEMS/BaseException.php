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
    protected $_name;

    function __construct($name, $message, $code = 0, Exception $previous = null) {
        $this->_name = $name;

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     * @ignore
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Custom string representation of object
     *
     * @return string
     * @ignore
     */
    public function __toString() {
        return get_class($this) . ": [{$this->_name}] {$this->_message}\n";
    }
}