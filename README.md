cems-php-sdk
============
This is the official PHP-SDK for CEMS's API. [View api documentation and examples.](https://docs.cemsadmin.apiary.io)

##Build Status
[![Build Status](https://travis-ci.org/siliconstraits/cems-php-sdk.svg?branch=master)](https://travis-ci.org/siliconstraits/cems-php-sdk)

##Installation

### Requirements

1. PHP >= 5.4
2. PHP curl extensions.

You don't need to clone the repo directly to use this SDK, the entire library and its dependencies can be installed through Composer ( [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md) ).

- First, install Composer if you don't have it already

```shell
curl -sS https://getcomposer.org/installer | php
```

- Create `composer.json` and add the following

```json
{
   "require": {
       "siliconstraits/cems-php-sdk": "dev-master"
   }
}
```

- Install `cems-php-sdk` package via Composer

```shell
php composer.phar install
```

- Include the library in your script

```php
require_once 'vendor/autoload.php';
```

- See below for how to configure your Client class.

##Configuration

All CEMS API requests can be made using the `CEMS\Client` class. This class must be initialized with your authentication details such as an API key (preferred), email/password combo. Remember to declare the API URL from CEMS service for proper connection to your own server.

### API key Config

```php
$client = new CEMS\Client($access_token, $apiUrl);
```

### Email/Password Config

```php
$client = new CEMS\Client($email, $password, $apiUrl);
```

Your app users are almost ready to start signing!
See below for the most common use cases for this wrapper.

##Usage
---------------------

### Create a RESTful Request

You can create a RESTful request by using following method from an instance of Client class:

- `request($httpMethod, $path, $params = NULL)`

For example:

```php
try {
  $response= $client->get(
    'events',
    array(
        'category_id' => array(1, 2)
    )
  ); // CEMS\Response
}
catch (CEMS\Error $e) {
    echo $e;
}
```

Or

```php
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

Or using these alias below:

- `get($path, $params = NULL)`
- `post($path, $params = NULL)`
- `put($path, $params = NULL)`
- `delete($path, $params = NULL)`

*NOTE*: You must provide the right path from API documentation.

The request will automatically return a Response object contain JSON data return from API if success. Then you can retrieve the proper result by using the method `getObject($type='CEMS\Resource')` or `getObjectList($type='CEMS\Resource')`

```php
$customer = $client->request('GET',"customers/$id')->getObject(); // CEMS\Object

$customers = $client->request('GET','customers')->getObjectList('customer'); // array of CEMS\Customer
```

### Retrieving fields returned from the API

Using magic methods to set or get fields

```php
$customer->name('Hoang Van Tien');
echo $customer->name();
```

Or if you want to get all attributes in an array

```php
foreach ($customers as $customer) {
  print_r($customer->toArray());
  // toObject()
}
```

##Testing
---------------------

This project contains PHPUnit tests that check the SDK code and can also be referenced for examples. Most are functional and integrated tests that walk through real user scenarios. In some cases, this means you must have an active network connection with access to HelloSign to execute all tests. Also, your testing account will need at least 1 template for the template tests to pass.

*** WARNING: these tests will add and remove users from your team. Use with caution.

### To run the tests

- Copy file `phpunit.xml.sample` to `phpunit.xml`
- Edit the new file, uncomment and enter your `API_KEY`, `CLIENT_ID`, `CLIENT_SECRET` and `CALLBACK_URL`
- Make sure your account has at least 1 template
- Run `./vendor/bin/phpunit`