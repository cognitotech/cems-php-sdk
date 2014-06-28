cems-php-sdk
============

```php
$client = new CEMS\CemsClient($email, $password, $apiUrl);
$client = new CEMS\CemsClient($access_token, $apiUrl);

try {
  $response= $client->request('GET','events', array(
    'category_id' => array(1, 2)
  )); // CEMS\CemsResponse
catch (CEMS\CemsError $e) {
}

$client->request('GET',"customers/$id')->getObject(); // CEMS\Object

$customers = $client->request('GET','customers')->getObjectList('customer'); // array of CEMS\CemsCustomer

foreach ($customers as $customer) {
  print_r($customer->toArray());
  // toObject()
}


$client->request('POST',"subscriptions", array(
	'abc' => $abc
));
$client->request('PUT',"subscriptions/$id", array(
	'abc' => $abc
));
$client->request('GET','subscriptions/find_by', array(
	'customer_id'			=> $customer_id,
	'subscriber_list_id'	=> $subscriber_list_id
));
```
