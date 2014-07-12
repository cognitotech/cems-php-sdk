<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 7/12/14
 * Time: 1:25 PM
 */

namespace CEMS;
use Guzzle\Client as GuzzleClient;
use Guzzle\Http\Exception as GuzzleException;

class Guzzle3 implements GuzzleStrategy{
    /**
     * Guzzle3 Request implementation
     *
     * @param string $httpMethod
     * @param string $path
     * @param array $params
     * @param null $version
     * @param bool $isAuthorization
     * @return Response|mixed
     * @throws ClientException
     * @throws AuthorizeException
     * @throws ServerException
     * @throws Error
     */
    public function request($httpMethod='GET', $path='',  array $params = null, $version = null,$isAuthorization=false)
    {
        //TODO: Implement Guzzle 3 here
    }
} 