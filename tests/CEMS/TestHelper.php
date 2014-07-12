<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 7/12/14
 * Time: 2:14 PM
 */

namespace CEMS\Tests;


class TestHelper {

    static function setEnvVar()
    {

        $keys = array(
            'API_KEY',
            'CLIENT_PASSWORD',
            'CLIENT_EMAIL',
            'API_URL'
        );

        foreach ($keys as $key) {
            array_key_exists($key, $_SERVER) && $_ENV[$key] = $_SERVER[$key];
        }

    }
} 