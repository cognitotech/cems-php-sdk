<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 7/12/14
 * Time: 1:25 PM
 */

namespace CEMS;

use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Http\Exception as GuzzleException;

/**
 * Class Guzzle3
 * @package CEMS
 */
class Guzzle3 implements GuzzleStrategy
{
    /**
     * Guzzle3 Request implementation
     *
     * @param string $httpMethod
     * @param string $path
     * @param array $params
     * @param null $version
     * @param bool $isAuthorization
     *
     * @return Response|mixed
     * @throws ClientException
     * @throws AuthorizeException
     * @throws ServerException
     * @throws Error
     */
    public function request($httpMethod = 'GET', $path = '', $params = array(), $version = null, $isAuthorization = false)
    {
        //TODO: Implement Guzzle 3 here
        $guzzleClient = new GuzzleClient();
        switch ($httpMethod) {
            case 'GET':
                //TODO: array liked param need manual parser
                $request = $guzzleClient->get($path, array(), array('query' => $params));
                break;
            default:
                //default:'Content-Type'=>'application/json' for "*.json" URI
                $json_body = json_encode($params);
                $request = $guzzleClient->createRequest($httpMethod, $path, array(), $json_body);
                $request->setHeader('Content-Type', 'application/json');
        }
        try {
            $res = $request->send();
        } catch (GuzzleException\ClientErrorResponseException $e) {
            //catch error 404
            $error_message = $e->getResponse();
            if ($isAuthorization)
                throw new AuthorizeException($error_message, $error_message->getStatusCode(), $e->getPrevious());
            else
                throw new ClientException($error_message, $e->getResponse()->getStatusCode(), $e->getPrevious());
        } catch (GuzzleException\ServerErrorResponseException $e) {
            throw new ServerException($e, '$e->getResponse()->getStatusCode()', $e->getPrevious());
        } catch (GuzzleException\BadResponseException $e) {
            throw new Error($e->getResponse(), $e->getResponse()->getStatusCode(), $e->getPrevious());
        }
        $response = new Response($res->json());

        return $response;
    }
} 