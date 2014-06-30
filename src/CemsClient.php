<?php
/**
 * Created by PhpStorm.
 * User: pnghai179
 * Date: 24/06/2014
 * Time: 13:45
 */

namespace CEMS;
require_once './vendor/autoload.php';
use GuzzleHttp\Client as GuzzleClient;

class CemsClient {
    private $_accessToken;
    private $_apiUrl;
    private $_client;

    function __construct()
    {
        $this->_client = new GuzzleClient();
        $a = func_get_args();
        $i = func_num_args();

        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

    function __construct2($access_token='', $api_url='')
    {
        $this->_apiUrl=$api_url;
        $this->_accessToken=$access_token;
    }

    function __construct3($email='', $password='',$api_url='')
    {

        $this->_apiUrl=$api_url;
        $res = $this->_client->get($this->_apiUrl.'/staffs/sign_in.json', [
            'staff' =>  [$email, $password]
        ]);

        echo $res->getStatusCode();           // 201
        echo $res->getHeader('content-type'); // 'application/json; charset=utf8'
        $JSON_response=$res->getBody()->json();                 // {"access_token":"d5uV-zgVVYz2ekSQ4vf6"}

        $this->_accessToken = $JSON_response['access_token'];
    }
    function __destruct() {
    }

    /*
     * string $httpMethod,
     * string $path,
     * array $params = NULL,
     * string $version = NULL
     */
    public function request($httpMethod, $path, $params = NULL, $version = NULL)
    {
        $request = $this->_client->createRequest($httpMethod, $path);
        $request->setHeader('Access_Token', $this->_accessToken);
        switch ($httpMethod){
            case 'GET':
                $query = $request->getQuery();
                foreach ($params as $param => $value)
                    $query->set($param, $value);
                break;
            default:
                $postBody = $request->getBody();

                // $postBody is an instance of GuzzleHttp\Post\PostBodyInterface
                foreach ($params as $param => $value)
                    $postBody->setField($param, $value);
        }
        $res=$this->_client->send($request);
        $response = new CemsResponse($res->body()->json());
        return $response;
    }
}