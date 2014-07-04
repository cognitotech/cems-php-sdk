<?php

/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 04/07/2014
 * Time: 17:47
 */
class SubscriptionTest extends ResourceTest
{
    public function testCreateSubscription()
    {
        $this->_resource=new CEMS\Subscription('');
        $this->_resource->name='';
        $this->_resource->name='';
        $this->_resource->name='';
        $this->_resource->name='';
        $this->_client->post('/admin/subscriptions.json',$this->_resource->toArray());
    }

    public function testGetSingleSubscription()
    {
        $_resource=$this->_client->get('subscriptions/');
    }

    public function testFetchSubscriptionCollection()
    {
        #todo: return page num, cur page.
    }


    public function testUpdateSubscription()
    {

    }

    public function testDeleteSubscription()
    {

    }
}
 