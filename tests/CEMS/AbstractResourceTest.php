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
    protected $_client;

    protected $_resource;

    protected $_collection;

    /**
     * Setup API Client ready for Test
     */
    protected function setUp()
    {
        parent::setUp();
        TestHelper::setEnvVar();
        $this->_client = new CEMS\Client($_ENV['API_KEY'], $_ENV['API_URL']);
    }
}
 