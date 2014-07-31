<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 24/06/2014
 * Time: 14:20
 */
namespace CEMS\Tests;

use CEMS;
use CEMS\Client;

/**
 * Class ClientTest
 * @package CEMS\Tests
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group Sign In Test
     * @covers Client::getAccessToken
     */
    public function testAccessToken()
    {
        $cemsClient = new Client($_ENV['CLIENT_EMAIL'], $_ENV['CLIENT_PASSWORD'], $_ENV['API_URL']);
        $this->assertEquals($cemsClient->getAccessToken(), $_ENV['API_KEY']);

    }

    protected function setUp()
    {
        parent::setUp();
        ClientTest::setEnvVar();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
