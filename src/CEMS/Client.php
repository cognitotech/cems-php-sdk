<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 24/06/2014
 * Time: 13:45
 */

namespace CEMS;

require_once dirname(dirname(dirname(__FILE__))) . './vendor/autoload.php';
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 * @package CEMS
 */
class Client
{
    /**
     * @var string
     */
    protected $_accessToken = '';

    /**
     * @var string
     */
    protected $_apiUrl = '';

    /**
     * @var array|\GuzzleHttp\Client
     */
    protected $_client = array();

    /**
     * parse arguments and go to corresponding constructor
     */
    function __construct()
    {
        $this->_client = new GuzzleClient();
        $a = func_get_args();
        $i = func_num_args();

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
        $this->_apiUrl = $api_url;
        $this->_accessToken = $access_token;
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $api_url
     */
    function __construct3($email = '', $password = '', $api_url = '')
    {

        $this->_apiUrl = $api_url;
        $res = $this->_client->post($this->_apiUrl . '/staffs/sign_in.json', [
            'body' => [
                'staff[email]' => $email,
                'staff[password]' => $password
            ]
        ]);

        echo $res->getStatusCode(); // 201
        echo $res->getHeader('content-type');
        $JSON_response = $res->json();

        $this->_accessToken = $JSON_response['access_token'];
    }

    function __destruct()
    {
    }

    /**
     * @param      $httpMethod
     * @param      $path
     * @param null $params
     * @param null $version
     *
     * @return Response
     */
    public function request($httpMethod, $path, $params = null, $version = null)
    {
        $request = $this->_client->createRequest($httpMethod, $path);
        $request->setHeader('Access_Token', $this->_accessToken);
        switch ($httpMethod) {
            case 'GET':
                $query = $request->getQuery();
                foreach ($params as $param => $value)
                    $query->set($param, $value);
                break;
            default:
                $postBody = $request->getBody();

                // $postBody is an instance of GuzzleHttp\Post\PostBodyInterface
                foreach ($params as $param => $value)
                    $pieces = explode("s/", $path);
                $postBody->setField($pieces[0] . '[' . $param . ']', $value);
        }
        $res = $this->_client->send($request);
        #TODO: parse error here
        $response = new Response($res->json());

        return $response;
    }

    /**
     * @param      $path
     * @param null $params
     * @param null $version
     *
     * @return Response
     */
    public function get($path, $params = null, $version = null)
    {
        return $this->request('GET', $path, $params = null, $version = null);
    }

    /**
     * @param      $path
     * @param null $params
     * @param null $version
     *
     * @return Response
     */
    public function post($path, $params = null, $version = null)
    {
        return $this->request('POST', $path, $params = null, $version = null);
    }

    /**
     * @param      $path
     * @param null $params
     * @param null $version
     *
     * @return Response
     */
    public function put($path, $params = null, $version = null)
    {
        return $this->request('PUT', $path, $params = null, $version = null);
    }

    /**
     * @param      $path
     * @param null $params
     * @param null $version
     *
     * @return Response
     */
    public function delete($path, $params = null, $version = null)
    {
        return $this->request('DELETE', $path, $params = null, $version = null);
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->_apiUrl;
    }
}