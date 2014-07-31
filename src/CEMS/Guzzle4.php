<?php
/**
 * Created by PhpStorm.
 * User: pnghai
 * Date: 7/12/14
 * Time: 1:28 PM
 */

namespace CEMS;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception as GuzzleException;


class Guzzle4 implements GuzzleStrategy
{
    /**
     * Guzzle 4 Request method implementation
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
    public function request($httpMethod = 'GET', $path = '', array $params = null, $version = null, $isAuthorization = false)
    {
        $guzzleClient = new GuzzleClient();
        switch ($httpMethod) {
            case 'GET':
                $request = $guzzleClient->createRequest($httpMethod, $path, array('query' => $params));
                break;
            default:
                $request = $guzzleClient->createRequest($httpMethod, $path, array('body' => $params));
        }
        try {
            $res = $guzzleClient->send($request);
        } catch (GuzzleException\ClientException $e) {
            //catch error 404
            $error_message = $e->getResponse();
            if ($isAuthorization)
                throw new AuthorizeException($error_message, $e->getCode(), $e->getPrevious());
            else
                throw new ClientException($error_message, $e->getCode(), $e->getPrevious());
        } catch (GuzzleException\ServerException $e) {
            throw new ServerException($e, $e->getCode(), $e->getPrevious());
        } catch (GuzzleException\BadResponseException $e) {
            throw new Error($e->getResponse(), $e->getCode(), $e->getPrevious());
        }
        $response = new Response($res->json());

        return $response;
    }
} 