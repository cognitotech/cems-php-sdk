cems-php-sdk
============

```php
$client = new CEMS\Client($email, $password);
$client = new CEMS\Client($access_token);

$client->get('events', array(
  'category_id' => array(1, 2)
)); // CEMS\Collection

$client->get('customers'); // CEMS\Collection

$client->get("customers/$id"); // CEMS\Resource
$client->post("subscriptions", array(
	'abc' => $abc
));
$client->put("subscriptions/$id", array(
	'abc' => $abc
));
$client->get('subscriptions/find_by', array(
	'customer_id'			=> $customer_id,
	'subscriber_list_id'	=> $subscriber_list_id
));
```
