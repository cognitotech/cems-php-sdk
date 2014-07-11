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
        return get_class($this);
    }

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
        $result=array();
        foreach ($messages as $k=>$v)
            if ($v!=null)
            {
                if (is_array($v))
                {
                    $error_text=array();
                    foreach ($v as $error)
                        array_push($error_text,$error);
                    $error_text=implode($error_text,',');
                    array_push($result,"$k:$error_text");
                }
                else array_push($result,"$k:$v");
            }
        $result=implode($result,';');
        return $result;
    }
    public function __toString() {
        return get_class($this). ": [{$this->code}]: {$this->getFormattedMessage()}";
    }

}