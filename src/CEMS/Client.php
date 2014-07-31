<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 24/06/2014
 * Time: 13:45
 */

namespace CEMS;

/**
 * Class Client
 * @package CEMS
 */
class Client
{
//TODO: convert to Singleton Object
    /**
     * @var string
     */
    protected $accessToken = '';

    /**
     * @var string
     */
    protected $apiUrl = '';

    /**
     * Guzzle Interface for compatible with old PHP 5.3 and 5.4+
     * @var GuzzleStrategy
     */
    protected $strategy;

    /**
     * Helper function for determine PHP version
     */
    protected function getPHPVersion()
    {
        $version = explode('.', PHP_VERSION);
        if (!defined('PHP_VERSION_ID')) {
            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        }
        if (PHP_VERSION_ID < 50207) {
            define('PHP_MAJOR_VERSION', $version[0]);
            define('PHP_MINOR_VERSION', $version[1]);
            define('PHP_RELEASE_VERSION', $version[2]);
        }
    }

    /**
     * parse arguments and go to corresponding constructor
     * @return Client object
     */
    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        $this->getPHPVersion();
        if (PHP_MAJOR_VERSION == 5) {
            if (PHP_MINOR_VERSION >= 3)
                $this->strategy = new Guzzle3();
            //if (PHP_MINOR_VERSION>=4)
            //    $this->strategy=new Guzzle4();
        } //TODO: should through 'Not Compatible PHP Version' message here
        if (method_exists($this, $f = '__construct' . $i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }

    /**
     * @param string $access_token
     * @param string $api_url
     */
    function __construct2($access_token = '', $api_url = '')
    {
        $this->apiUrl = $api_url;
        $this->accessToken = $access_token;
    }

    /**
     * Construct new Client Object
     *
     * @param string $email
     * @param string $password
     * @param string $api_url
     *
     * @return Client Client object
     * @throws BaseException
     */
    function __construct3($email = '', $password = '', $api_url = '')
    {
        $this->apiUrl = $api_url;
        try {
            $JSON_response = $this->request('POST',
                '/staffs/sign_in.json',
                array(
                    'email'    => $email,
                    'password' => $password
                ),
                null, true
            );
        } catch (BaseException $e) {
            throw $e;
        }
        if (isset($JSON_response)) {
            $this->accessToken = $JSON_response->access_token;
        }
    }

    function __destruct()
    {

    }

    /**
     * Request method
     *
     * @param string $httpMethod
     * @param string $path
     * @param array $params
     * @param null $version
     * @param bool $isAuthorization
     *
     * @return Response
     * @throws ClientException
     * @throws AuthorizeException
     * @throws ServerException
     * @throws Error
     */
    public function request($httpMethod = 'GET', $path = '', $params = array(), $version = null, $isAuthorization = false)
    {
        if ($httpMethod != 'GET') {
            $post_params = array();
            if (!$isAuthorization) {
                $post_params['access_token'] = $this->accessToken;
                $api_callback = ApiHelper::getBetween($path, 'admin/', '.json');
                $parser = explode('/', $api_callback);
                $api_callback = substr($parser[0], 0, -1); //get singular string by remove last s
                //TODO: get proper singular string for '-es' case.
                if (!empty($params))
                    $post_params[$api_callback] = $params;

            } else {
                $post_params['staff'] = $params;
            }
            $params = $post_params;
        } else {
            //add access_token to GET api
            $params['access_token'] = $this->accessToken;
        }

        return $this->strategy->request(
            $httpMethod,
            $this->apiUrl . $path,
            $params, $version, $isAuthorization
        );
    }

    /**
     * @param      $path
     * @param array $params
     * @param null $version
     *
     * @return Response
     */
    public function get($path, $params = array(), $version = null)
    {
        return $this->request('GET', $path, $params, $version);
    }

    /**
     * @param      $path
     * @param array $params
     * @param null $version
     *
     * @return Response
     */
    public function post($path, $params = array(), $version = null)
    {
        return $this->request('POST', $path, $params, $version);
    }

    /**
     * @param      $path
     * @param array $params
     * @param null $version
     *
     * @return Response
     */
    public function put($path, $params = array(), $version = null)
    {
        return $this->request('PUT', $path, $params, $version);
    }

    /**
     * @param      $path
     * @param array $params
     * @param null $version
     *
     * @return Response
     */
    public function delete($path, $params = array(), $version = null)
    {
        return $this->request('DELETE', $path, $params, $version);
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }
}