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
    /**
     * Save response data
     * @var null
     */
    protected $_response;

    function __construct($message=null, $code = 0, Exception $previous = null) {
        // make sure everything is assigned properly
        $this->_response=$message;
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

    /**
     * Helper function to get right exception raise from CEMS API
     * @return mixed
     */
    public function getFormattedMessage(){
        $json=$this->_response->json();

        $messages=$json;
        if (isset($json['error']))
            $messages=$json['error'];
        if (isset($json['errors']))
            $messages=$json['errors'];

        return serialize($messages);
    }
    public function __toString() {
        return __CLASS__. ": [{$this->code}]: {$this->getFormattedMessage()}\n";
    }

}