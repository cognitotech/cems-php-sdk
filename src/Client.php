<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 24/06/2014
 * Time: 13:45
 */

namespace CEMS;


class Client {
    function __construct()
    {

        print "In constructor\n";
        $this->name = "ClientClass";

        $a = func_get_args();
        $i = func_num_args();

        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

    function __construct1($access_token='')
    {
        echo('__construct with access_token called: '.$access_token.PHP_EOL);
    }

    function __construct2($email='', $password='')
    {
        echo('__construct with 2 params called: '.$email.','.$password.PHP_EOL);
    }
    function __destruct() {
        print "Destroying " . $this->name . "\n";
    }
}