<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 05/07/2014
 * Time: 12:51
 */

namespace CEMS;

/**
 * Class Error contains Http request exception thrown when a bad response is received
 *
 * @package CEMS
 */
class Error extends BaseException
{
    /**
     * Print exception's message in following format: <ExceptionClassName>: [<status_code>]: <formatted reason>
     *
     * @return string
     */
    public function __toString()
    {

        $dump = $this->varDumpToString($this->_message);

        return get_class($this) . ":[{$this->code}]: {$dump}\n";
    }

    /**
     * Helper for export var_dump object to string
     *
     * @param $var
     *
     * @return string
     */
    public function varDumpToString($var)
    {
        ob_start();
        var_dump($var);

        return ob_get_clean();
    }
} 