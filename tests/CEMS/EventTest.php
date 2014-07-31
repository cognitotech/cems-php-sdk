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
    public function testCreateEvent()
    {
        /*
        $this->_resource=new CEMS\Event(array(
            'first_name'=>'Hai',
        ));
        $this->assertArrayHasKey('password',$this->_resource->toArray());
        $this->_resource->phone='0123456789';
        $this->assertEquals('0123456789',$this->_resource->phone);
        $event=$this->_client->post('/admin/events.json',$this->_resource->toArray())->getObject('CEMS\Event');
        $this->assertContains('id',$event->getPropertyNames());
        $this->assertContains("avatars/male.png",$event->getPropertyAsArray());
        return $event;
        */
    }


    /**
     * @depends testCreateEvent
     */
    public function testGetSingleEvent($event)
    {
        /*
        $this->_resource=$event;
        $this->assertNotNull($this->_resource->id);
        $event=$this->_client->get('/admin/events/'.$this->_resource->id.'.json')->getObject('CEMS\Event');
        $this->assertEquals($this->_resource->id,$event->id);
        */
    }

    public function testFetchEventCollection()
    {
        //todo: return page num, cur page.
        $this->_resource = $this->_client->get('/admin/events.json');
        $this->assertInstanceOf('CEMS\Response', $this->_resource);
        $this->assertEquals(1, $this->_resource->current_page);
        $events = $this->_resource->getObjectList('CEMS\Event')->toArray();
        $this->assertInstanceOf('CEMS\Event', $events[0]);
    }

    /**
     * @depends testCreateEvent
     */
    public function testUpdateEvent($event)
    {
        /*
        $this->_resource=$event;
        $this->_resource->last_name="Phan Nguyen";
        $this->_resource->phone="01273451490";
        $this->_client->put('/admin/events/'.$this->_resource->id.'.json',$this->_resource->toArray());
        $event=$this->_client->get('/admin/events/'.$this->_resource->id.'.json')->getObject('CEMS\Event');
        $this->assertEquals($this->_resource->last_name,$event->last_name);
        $this->assertEquals($this->_resource->phone,$event->phone);
        */
    }

    /**
     * @depends testCreateEvent
     */
    public function testDeleteEvent($event)
    {
        /*
        $this->_resource=$event;
        $this->assertNotNull($this->_resource->id);
        $this->_resource=$this->_client->delete('/admin/events/'.$this->_resource->id.'.json');
        */
    }
}
 