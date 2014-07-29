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
     * @covers Customer::_construct
     * @covers magic Customer::__get
     * @covers Client::post
     * @covers Response::getObject
     * @covers Customer::toArray
     * @covers Customer::getPropertyArray
     * @covers Customer::getPropertyNames
     */
    public function testCreateCustomer()
    {
        $this->_resource=new CEMS\Customer(array(
            'first_name'=>'Hai',
            'last_name'=>'Phan',
            'gender' => 'male',
            'birthday' => '17/09/1990',
            'address' => 'test',
            'email' => 'customer-testv2@cems.php.sdk',
            'phone' => '9999'
        ));
        $this->_resource->password='testtest';
        $this->assertArrayHasKey('password',$this->_resource->toArray());
        $this->_resource->phone='01273451490';
        $this->assertEquals('01273451490',$this->_resource->phone);
        $customer=$this->_client->post('/admin/customers.json',$this->_resource->toArray())->getObject('CEMS\Customer');
        $this->assertContains('id',$customer->getPropertyNames());
        $this->assertContains("avatars/male.png",$customer->getPropertyAsArray());
        return $customer;
    }


    /**
     * @depends testCreateCustomer
     * @covers Client::get
     * @covers Customer::_construct
     * @covers magic Customer::__get
     */
    public function testGetSingleCustomer($customer)
    {
        $this->_resource=$customer;
        $this->assertNotNull($this->_resource->id);
        $customer=$this->_client->get('/admin/customers/'.$this->_resource->id.'.json')->getObject('CEMS\Customer');
        $this->assertEquals($this->_resource->id,$customer->id);
    }

    /**
     * @covers Collection::toArray
     * @covers Response::getObjectList
     */
    public function testFetchCustomerCollection()
    {
        //todo: return page num, cur page.
        $this->_resource=$this->_client->get('/admin/customers.json');
        $this->assertInstanceOf('CEMS\Response',$this->_resource);
        $this->assertEquals(1,$this->_resource->current_page);
        $customers=$this->_resource->getObjectList('CEMS\Customer');
        $this->assertInstanceOf('CEMS\Customer',$customers->toArray()[0]);
    }

    /**
     * @depends testCreateCustomer
     * @covers Client::put
     * @covers Customer::__set
     * @param CEMS\Customer $customer
     */
    public function testUpdateCustomer($customer)
    {
        $this->_resource=$customer;
        $this->_resource->last_name="Phan Nguyen";
        $this->_resource->phone="0983123123";
        $this->assertInstanceOf('CEMS\Response',$this->_client->put('/admin/customers/'.$this->_resource->id.'.json',$this->_resource->toArray()));
        $customer=$this->_client->get('/admin/customers/'.$this->_resource->id.'.json')->getObject('CEMS\Customer');
        $this->assertEquals($this->_resource->last_name,$customer->last_name);
        $this->assertEquals($this->_resource->phone,$customer->phone);
    }

    /**
     * @depends testCreateCustomer
     * @covers Client::delete
     */
    public function testDeleteCustomer($customer)
    {
        $this->_resource=$customer;
        $this->assertNotNull($this->_resource->id);
        $this->assertInstanceOf('CEMS\Response',$this->_client->delete('/admin/customers/'.$this->_resource->id.'.json'));
    }
}
 