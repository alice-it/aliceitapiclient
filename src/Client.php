<?php

namespace AliceIT;

use AliceIT\Exception\MalformedException;
use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class Client
{
    private $httpClient;
    private $apiToken;
    private $url = "https://meine.alice-it.de/api/v1/";

    /**
     * Client constructor.
     * @param $apiToken
     */
    public function __construct($apiToken)
    {
        $this->setHttpClient();
        $this->apiToken = $apiToken;

    }

    private function setHttpClient(){
        $this->httpClient = new \GuzzleHttp\Client([
            'allow_redirects' => false, 'timeout' => 90
        ]);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(){
        return $this->httpClient;
    }

    /**
     * @param $actionPath
     * @param array $params
     * @param string $method
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function request($actionPath, $params = [], $method = 'GET'){
        if(!is_array($params)){
            throw new MalformedException('wrong HTTP parameter');
        }

        $url = $this->url . $actionPath;

        switch($method){
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'headers'        => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->apiToken
                    ],
                    'verify' => false,
                    'query' => $params,
                ]);
                break;
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'headers'        => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->apiToken
                    ],
                    'verify' => false,
                    'query' => [
                        'api_token' => $this->apiToken,
                    ],
                    'form_params' => $params
                ]);
                break;
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'headers'        => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->apiToken
                    ],
                    'verify' => false,
                    'query' => [
                        'api_token' => $this->apiToken,
                    ],
                    'form_params' => $params
                ]);
                break;
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'headers'        => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->apiToken
                    ],
                    'verify' => false,
                    'query' => [
                        'api_token' => $this->apiToken,
                    ],
                    'form_params' => $params
                ]);
                break;
            default:
                throw new MalformedException('HTTP Method wrong');
        }
    }

    /**
     * @param $response
     * @return mixed
     */
    private function parseRequest($response, $code = "")
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            if(isset($result->errors))
                $result->success = false;

            if(!empty($code)){
                $result->code = $code;
            }

            return $result;
        } else {
            return $response;
        }
    }

    /**
     * @param $actionPath
     * @param array $params
     * @return mixed
     */
    public function get($actionPath, $params = [])
    {
        $code = "";
        try{
            $response = $this->request($actionPath, $params);
        }catch(ClientException $e){
            $code = $e->getCode();
            $response = $e->getResponse();
        }
        
        return $this->parseRequest($response, $code);
    }

    /**
     * @param $actionPath
     * @param array $params
     * @return mixed
     */
    public function put($actionPath, $params = [])
    {
        $code = "";
        try{
            $response = $this->request($actionPath, $params, 'PUT');
        }catch(ClientException $e){
            $code = $e->getCode();
            $response = $e->getResponse();
        }
        
        return $this->parseRequest($response, $code);
    }

    /**
     * @param $actionPath
     * @param array $params
     * @return mixed
     */
    public function post($actionPath, $params = [])
    {
        $code = "";
        try{
            $response = $this->request($actionPath, $params, 'POST');
        }catch(ClientException $e){
            $code = $e->getCode();
            $response = $e->getResponse();
        }
        
        return $this->parseRequest($response, $code);
    }

    /**
     * @param $actionPath
     * @param array $params
     * @return mixed
     */
    public function delete($actionPath, $params = [])
    {
        $code = "";
        try{
            $response = $this->request($actionPath, $params, 'DELETE');
        }catch(ClientException $e){
            $code = $e->getCode();
            $response = $e->getResponse();
        }
        
        return $this->parseRequest($response, $code);
    }

    private $servicesHandler;
    public function services(){
        if(!$this->servicesHandler) {
            $this->servicesHandler = new ServicesHandler($this);
        }

        return $this->servicesHandler;
    }
}
