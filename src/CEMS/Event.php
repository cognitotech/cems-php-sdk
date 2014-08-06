<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 29/06/2014
 * Time: 00:22
 */

namespace CEMS;

/**
 * Class Event is a concreted class of the abstract CEMS\Resource class
 *
 * @package CEMS
 * @property int $id Event ID
 * @property int $category_id Category ID
 * @property string $code Code
 * @property string $title Title
 * @property string $start_at Started Date
 * @property string $end_at Ended Date
 * @property bool $is_daylong Daylong Flag
 * @property string $venue Venue
 * @property string $description Description
 * @property bool $is_confirmable Comfirmable Flag
 * @property int $max_register Max Register Amount
 * @property int $term_id Term ID
 * @property string $status Status
 * @property array $visible_form_fields Visible Form Fields
 * @property bool $is_public Public Flag
 * @property string $head_tracking_code Head Tracking Code
 * @property string $body_tracking_code Body Tracking Code
 * @property array $hidden_info Hidden Infos
 * @property int $original_fees Originial Fees
 * @property int $incentive_fees Incentive Fees
 * @property string $note Note
 * @property string $created_at Created At
 * @property string $updated_at Updated At
 * @property string $current_fees_formated Current Fees Format
 * @property string $original_fees_formated Original Fees Format
 * @property array $category Category
 * @property array $customer_counts_by_group {
 *    An array of  Customer Counts by group
 *
 * @type int $yesterday Yesterday Counter
 * @type int $total Total Counter
 * @type int $potential Potential Counter
 * @type int $not_interested Not Interested Counter
 * @type int $interested Interested Counter
 * @type int $committed Committed Counter
 * @type int $confirmed Confirmed Counter
 * @type int $attended Attended Counter
 * @type int $cancelled Cancelled Counter
 * }
 */
class Event extends Resource
{

} 