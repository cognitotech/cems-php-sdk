<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:22
 */

namespace CEMS;

/**
 * Class EventRegister is a concreted class of the abstract CEMS\Resource class
 *
 * This contains data of event registered with a specific customer
 *
 * @package CEMS
 * @property int $id EventRegister ID
 * @property int $event_id Event ID
 * @property int $customer_id Customer ID
 * @property int $status_id Status ID
 * @property int $fees Fees
 * @property string $payment_status Payment Status
 * @property string $access_token Access Token
 * @property string $group_id Group ID
 * @property int $fees_condition_id Fees Condition ID
 * @property int $discount_preset_id Discount Preset ID
 * @property string $status_updated_at Status Update At
 * @property int $status_updated_by_id Status Updated By ID
 * @property int $updated_by_id Updated By ID
 * @property string $note Note
 * @property string $cems_plan CEMS Plan
 * @property string $created_at Created At
 * @property string $updated_at Updated At
 * @property string $payment_status_text Payment Status Text
 * @property int $amount_paid Amount Paid
 * @property array $discounts Discounts
 * @property int $calculated_fees Calculated Fees
 * @property string $calculated_fees_formated Calculated Fees Formatted
 * @property int $before_discounted_fees Before Discounted Fees
 * @property string $amount_paid_formated Amount Paid
 * @property array $status {
 *    An array of status
 *
 * @type string $color Color
 * @type string $title Title
 * }
 */
class EventRegister extends Resource
{

} 