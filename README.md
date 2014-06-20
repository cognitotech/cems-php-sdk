cems-php-sdk
============

```php
$client = new CEMS\Client($email, $password);
$client = new CEMS\Client($access_token);

try {
  $client->get('events', array(
    'category_id' => array(1, 2)
  )); // CEMS\Collection
catch (CEMS\Error $e) {
}

$customers = $client->get('customers'); // CEMS\Collection

foreach ($customers as $customer) {
  print_r($customer->toArray());
  // toObject()
}

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
