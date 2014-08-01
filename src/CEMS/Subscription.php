<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 28/06/2014
 * Time: 23:58
 */

namespace CEMS;

/**
 * Class Subscription is a concreted class of the abstract CEMS\Resource class
 *
 * Subscription is a class contain subscription data from the CEMS API Server
 *
 * Example usage:
 * $client=new Client(...)
 * $subscription=$client->getObject('CEMS\Subscription')
 * echo $subscription->id;
 *
 * @author   Hai Phan<pnghai@gmail.com>
 * @version  1.0
 * @package CEMS
 * @property int $id Subscription ID
 * @property int $customer_id Customer ID
 * @property int $subscriber_list_id Subscriber List ID
 * @property string $status Status
 * @property string $place Place
 * @property string $career Career
 * @property string $created_at Created At
 * @property string $updated_at Updated At
 */
class Subscription extends Resource
{

} 