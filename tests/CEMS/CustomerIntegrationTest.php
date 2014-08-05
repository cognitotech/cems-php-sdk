<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 04/07/2014
 * Time: 17:47
 */

namespace CEMS\Tests;

use CEMS;

/**
 * Class CustomerTest
 * @package CEMS\Tests
 */
class CustomerTest extends AbstractResourceTest
{
    /**
     * Test Customer Creation
     *
     * Return customer object for further testing
     *
     * @covers Customer::_construct
     * @covers magic Customer::__get
     * @covers Client::post
     * @covers Response::getObject
     * @covers Customer::toArray
     * @covers Customer::getPropertyArray
     * @covers Customer::getPropertyNames
     *
     * @return object $customer Customer object
     */
    public function testCreateCustomer()
    {
        $this->resource = new CEMS\Customer(array(
            'first_name' => 'Hai',
            'last_name'  => 'Phan',
            'gender'     => 'male',
            'birthday'   => '17/09/1990',
            'address'    => 'test',
            'email'      => 'customer-testv2@cems.php.sdk',
            'phone'      => '9999'
        ));
        $this->resource->password = 'testtest';
        $this->assertArrayHasKey('password', $this->resource->toArray());
        $this->resource->phone = '01273451490';
        $this->assertEquals('01273451490', $this->resource->phone);
        $customer = $this->client->post('/admin/customers.json', $this->resource->toArray())->getObject('CEMS\Customer');
        $this->assertContains('id', $customer->getPropertyNames());
        $this->assertContains("avatars/male.png", $customer->getPropertyAsArray());

        return $customer;
    }

    /**
     * @depends testCreateCustomer
     * @covers  Client::get
     * @covers  Customer::_construct
     * @covers  magic Customer::__get
     */
    public function testGetSingleCustomer($customer)
    {
        $this->resource = $customer;
        $this->assertNotNull($this->resource->id);
        $customer = $this->client->get('/admin/customers/' . $this->resource->id . '.json')->getObject('CEMS\Customer');
        $this->assertEquals($this->resource->id, $customer->id);
    }

    /**
     * @covers Collection::toArray
     * @covers Response::getObjectList
     */
    public function testFetchCustomerCollection()
    {
        //todo: return page num, cur page.
        $this->resource = $this->client->get('/admin/customers.json');
        $this->assertInstanceOf('CEMS\Response', $this->resource);
        $this->assertEquals(1, $this->resource->current_page);
        $customers = $this->resource->getObjectList('CEMS\Customer');
        $collection = $customers->toArray();
        $this->assertInstanceOf('CEMS\Collection', $customers);
        $this->assertInstanceOf('CEMS\Customer', $collection[0]);
    }

    /**
     * @depends testCreateCustomer
     * @covers  Client::put
     * @covers  Customer::__set
     *
     * @param CEMS\Customer $customer
     */
    public function testUpdateCustomer($customer)
    {
        $this->resource = $customer;
        $this->resource->last_name = "Phan Nguyen";
        $this->resource->phone = "0983123123";
        $this->assertInstanceOf('CEMS\Response', $this->client->put('/admin/customers/' . $this->resource->id . '.json', $this->resource->toArray()));
        $customer = $this->client->get('/admin/customers/' . $this->resource->id . '.json')->getObject('CEMS\Customer');
        $this->assertEquals($this->resource->last_name, $customer->last_name);
        $this->assertEquals($this->resource->phone, $customer->phone);
    }

    /**
     * Test: fetch associated events of created customer
     * @depends testCreateCustomer
     * @covers  Client::get
     * @covers  Resource::__get
     *
     * @param CEMS\Customer $customer
     *
     * @return object $events EventRegister Collection
     */
    public function testGetEventsRegistered($customer)
    {
        $this->resource = $customer;
        $this->assertNotNull($this->resource->id);
        $response = $this->client->get('/admin/customers/' . $this->resource->id . '/event_registers.json');
        if ($response->total_entries>0)
        {
            $events = $response->getObjectList('CEMS\EventRegister');
            $collection = $events->toArray();
            $this->assertInstanceOf('CEMS\Collection', $events);
            $this->assertInstanceOf('CEMS\EventRegister', $collection[0]);
            return $events;
        }
        return null;
    }

    /**
     * Test: delete all associated events of created customer
     * @depends testGetEventsRegistered
     * @covers  Client::delete
     * @covers  Resource::__get
     *
     * @param CEMS\Collection $events
     */
    public function testDeleteEventsRegistered($events)
    {
        $this->collection = $events;
        $this->assertNotNull($this->collection);
        $event_array=$this->collection->toArray();
        foreach ($event_array as $event):
            $response = $this->client->delete('/admin/event_registers/' . $event->id . '.json');
            $this->assertEquals(204,$response->getStatusCode());
        endforeach;
    }

    /**
     * Test: fetch associated subscriptions of created customer
     * @depends testCreateCustomer
     * @covers  Client::get
     *
     * @param CEMS\Customer $customer
     *
     * @return object $subscriptions Subscription Collection
     */
    public function testGetAssociatedSubscriptions($customer)
    {
        $this->resource = $customer;
        $this->assertNotNull($this->resource->id);
        $response = $this->client->get('/admin/customers/' . $this->resource->id . '/subscriptions.json');
        if ($response->total_entries>0)
        {
            $subscriptions = $response->getObjectList('CEMS\Subscription');
            $collection = $subscriptions->toArray();
            $this->assertInstanceOf('CEMS\Collection', $subscriptions);
            $this->assertInstanceOf('CEMS\Subscription', $collection[0]);
            return $subscriptions;
        }
        return null;
    }

    /**
     * Test: delete all associated subscriptions of created customer
     * @depends testGetAssociatedSubscriptions
     * @covers  Client::delete
     *
     * @param CEMS\Collection $subscriptions
     */
    public function testDeleteAssociatedSubscription($subscriptions)
    {
        $this->collection = $subscriptions;
        $this->assertNotNull($this->collection);
        $subscription_array=$this->collection->toArray();
        foreach ($subscription_array as $subscription):
            $response = $this->client->delete('/admin/subscriptions/' . $subscription->id . '.json');
            $this->assertEquals(204,$response->getStatusCode());
        endforeach;
    }


    /**
     * @depends testCreateCustomer
     * @covers  Client::delete
     */
    public function testDeleteCustomer($customer)
    {
        $this->resource = $customer;
        $this->assertNotNull($this->resource->id);
        $this->assertInstanceOf('CEMS\Response', $this->client->delete('/admin/customers/' . $this->resource->id . '.json'));
    }
}
 