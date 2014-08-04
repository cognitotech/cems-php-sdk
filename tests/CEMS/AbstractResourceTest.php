<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 04/07/2014
 * Time: 17:14
 */

namespace CEMS\Tests;

use CEMS;

/**
 * Class AbstractResourceTest
 * @package CEMS\Tests
 */
abstract class AbstractResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CEMS\Client
     */
    protected $client;

    protected $resource;

    protected $collection;

    /**
     * Setup API Client ready for Test
     */
    protected function setUp()
    {
        parent::setUp();
        AbstractResourceTest::setEnvVar();
        $this->client = new CEMS\Client($_ENV['API_KEY'], $_ENV['API_URL']);
    }

    /**
     * Helper Class for Setting Environment Variables
     */
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
 