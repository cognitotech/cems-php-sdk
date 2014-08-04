<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 04/07/2014
 * Time: 17:52
 */
namespace CEMS\Tests;

use CEMS;

/**
 * Class EventTest
 * @package CEMS\Tests
 */
class EventTest extends AbstractResourceTest
{
    /**
     * Test Fetching Event Collection
     */
    public function testFetchEventCollection()
    {
        //todo: return page num, cur page.
        $this->resource = $this->client->get('/admin/events.json');
        $this->assertInstanceOf('CEMS\Response', $this->resource);
        $this->assertEquals(1, $this->resource->current_page);
        $events = $this->resource->getObjectList('CEMS\Event')->toArray();
        $this->assertInstanceOf('CEMS\Event', $events[0]);
    }

}