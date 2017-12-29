<?php
namespace Dandomain\Api;

use Dandomain\Api\Endpoint;
use Dandomain\Api\Exception\ProductNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Api {
    /**
     * Example: http://www.example.com
     *
     * @var string
     */
    protected $host;

    /**
     * The API key from your Dandomain admin
     *
     * @var string
     */
    protected $apiKey;

    /**
     * This is the HTTP client
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * Can be 'xml' or 'json'
     *
     * @var string
     */
    protected $contentType = 'json';

    /**
     * The HTTP method used for cURL
     *
     * @var string
     */
    protected $httpMethod = 'GET';

    /**
     * Whether the result should be saved in a file
     *
     * @var bool
     */
    protected $saveResult = false;

    /**
     * The directory to store any saved results
     *
     * @var string
     */
    protected $directory;

    /**
     * The file to save any results to
     *
     * @var string
     */
    protected $file;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * These are endpoints in the Dandomain API
     */

    /**
     * @var Endpoint\Customer
     */
    public $customer;

    /**
     * @var Endpoint\Discount;
     */
    public $discount;

    /**
     * @var Endpoint\Order;
     */
    public $order;

    /**
     * @var Endpoint\Product;
     */
    public $product;

    /**
     * @var Endpoint\ProductData;
     */
    public $productData;

    /**
     * @var Endpoint\ProductTag;
     */
    public $productTag;

    /**
     * @var Endpoint\RelatedData;
     */
    public $relatedData;

    /**
     * @var Endpoint\Settings;
     */
    public $settings;

    public function __construct($host, $apiKey, ClientInterface $client) {
        $this->setHost($host);
        $this->setApiKey($apiKey);
        $this->client = $client;

        $this->customer     = new Endpoint\Customer($this);
        $this->discount     = new Endpoint\Discount($this);
        $this->order        = new Endpoint\Order($this);
        $this->product      = new Endpoint\Product($this);
        $this->productData  = new Endpoint\ProductData($this);
        $this->productTag   = new Endpoint\ProductTag($this);
        $this->relatedData  = new Endpoint\RelatedData($this);
        $this->settings     = new Endpoint\Settings($this);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    public function call($method = 'GET', $uri, $options = array()) {
        $defaultOptions = array(
            'debug' => $this->debug,
            'headers' => array(
                'Accept' => 'application/json',
            ),
            'verify' => false,
            'connect_timeout' => 60,
            'timeout' => 600,
        );

        $options    = array_merge($defaultOptions, $options);
        $url        = $this->getHost() . str_replace('{KEY}', $this->getApiKey(), $uri);
        try {
            $response = $this->client->request($method, $url, $options);
            $this->response = $response;
        } catch (GuzzleException $e) {
            $newException = $this->parseException($e);
            if($newException) {
                throw $newException;
            }

            throw $e;
        }

        return $response;
    }

    protected function parseException(GuzzleException $e) {
        $exceptionMapping = [
            'client' => [
                [
                    'statusCode'    => 404,
                    'match'         => '/ProductNotFound/i',
                    'exception'     => '\Dandomain\Api\Exception\ProductNotFoundException',
                ],
                [
                    'statusCode'    => 400,
                    'match'         => '/ShippingMethodNotValid/i',
                    'exception'     => '\Dandomain\Api\Exception\ShippingMethodNotValidException',
                ]
            ]
        ];
        if($e instanceof ClientException) {
            /** @var ClientException $item */
            foreach ($exceptionMapping['client'] as $item) {
                if($e->getResponse()->getStatusCode() == $item['statusCode'] && preg_match($item['match'], $e->getResponse()->getBody()->getContents())) {
                    /** @var ClientException $newE */
                    $newE = new $item['exception']($e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
                    return $newE;
                }
            }
        }
        return false;
    }

    protected function getAcceptHeader() {
        if(stripos($this->contentType, 'json') !== false) {
            return 'application/json';
        } elseif(stripos($this->contentType, 'text') !== false){
            return 'text/plain';
        } else {
            return 'application/xml';
        }
    }

    protected function getSavePath() {
        if(is_null($this->directory)) {
            throw new \RuntimeException('No directory set.');
        }
        if(is_null($this->file)) {
            $this->file = 'DandomainApiResult' . date('YmdHis') . '-' . uniqid() . '.txt'; // using uniqid to avoid collissions
        }

        return $this->directory . DIRECTORY_SEPARATOR . $this->file;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Api
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return Api
     */
    public function setContentType($contentType)
    {
        $contentType = strtolower($contentType);

        if(!in_array($contentType, array('json', 'xml', 'text'))) {
            throw new \InvalidArgumentException('$contentType' . " can only be 'json', 'xml' or 'text'");
        }

        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     * @return Api
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Api
     */
    public function setHost($host)
    {
        $host = rtrim($host, '/');
        if(!filter_var($host, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("'$host' is not a valid URL");
        }
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return Api
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @return Api
     */
    public function setDirectory($directory)
    {
        $directory = rtrim($directory, '/\\');
        if(!is_dir($directory)) {
            throw new \InvalidArgumentException('$directory is not a valid directory');
        }
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return Api
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSaveResult()
    {
        return $this->saveResult;
    }

    /**
     * @param boolean $saveResult
     * @return Api
     */
    public function setSaveResult($saveResult)
    {
        $this->saveResult = $saveResult;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     * @return Api
     */
    public function setHttpMethod($httpMethod)
    {
        if(!in_array($httpMethod, array('GET', 'POST', 'DELETE', 'PUT'))) {
            throw new \InvalidArgumentException('$httpMethod not valid.');
        }
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        if(is_null($this->request)) {
            $this->request = new Request(Request::METHOD_GET, '/', $this->getHost());
        }
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Api
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        if(is_null($this->response)) {
            $this->response = new Response();
        }
        return $this->response;
    }

    /**
     * @param Response $response
     * @return Api
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }


}