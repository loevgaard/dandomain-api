<?php
namespace Dandomain\Api;

use Assert\Assert;
use Dandomain\Api\Endpoint;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @property Endpoint\Customer $customer
 * @property Endpoint\Order $order
 * @property Endpoint\Product $product
 * @property Endpoint\ProductData $productData
 * @property Endpoint\ProductTag $productTag
 * @property Endpoint\RelatedData $relatedData
 * @property Endpoint\Settings $settings
 */
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
     * @var Request
     */
    protected $request;

    /**
     * This is the last response
     *
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $requestOptions;

    /**
     * @var array
     */
    protected $defaultRequestOptions;

    /**
     * These are endpoints in the Dandomain API
     */
    /**
     * @var Endpoint\Customer
     */
    protected $customer;

    /**
     * @var Endpoint\Order;
     */
    protected $order;

    /**
     * @var Endpoint\Product;
     */
    protected $product;

    /**
     * @var Endpoint\ProductData;
     */
    protected $productData;

    /**
     * @var Endpoint\ProductTag;
     */
    protected $productTag;

    /**
     * @var Endpoint\RelatedData;
     */
    protected $relatedData;

    /**
     * @var Endpoint\Settings;
     */
    protected $settings;

    public function __construct(string $host, string $apiKey) {
        $host = rtrim($host, '/');

        Assert::that($host)->url('`$host` is not a valid URL');

        $this->host = $host;
        $this->apiKey = $apiKey;
        $this->requestOptions = [];
        $this->defaultRequestOptions = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'verify' => false,
        ];
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    public function request(string $method, string $uri, array $options = []) : ResponseInterface
    {
        try {
            // @todo instead of catching exception, set http errors to false
            // and return an error object according to http://jsonapi.org/format/#errors

            // merge all options
            // the priority is
            // 1. options supplied by the user
            // 2. options supplied by the method calling
            // 3. the default options
            $options = array_merge($this->defaultRequestOptions, $options, $this->requestOptions);
            $url = $this->host . str_replace('{KEY}', $this->apiKey, $uri);

            $this->response = $this->client->request($method, $url, $options);

            // reset request options
            $this->requestOptions = [];

            return $this->response;
        } catch (GuzzleException $e) {
            throw $this->parseException($e);
        }
    }

    /**
     * @param GuzzleException $e
     * @return \Exception
     */
    protected function parseException(GuzzleException $e) : \Exception
    {
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
            /** @var ClientException $e */
            foreach ($exceptionMapping['client'] as $item) {
                if($e->getResponse()->getStatusCode() == $item['statusCode'] && preg_match($item['match'], $e->getResponse()->getBody()->getContents())) {
                    /** @var ClientException $newE */
                    $newE = new $item['exception']($e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
                    return $newE;
                }
            }
        }
        return $e;
    }

    /**
     * This ensures lazy loading of the endpoint classes
     *
     * @param string $name
     * @return null
     */
    public function __get($name)
    {
        $className = 'Dandomain\\Api\\Endpoint\\'.ucfirst($name);
        if(property_exists(static::class, $name)) {
            if(!$this->{$name}) {
                $this->{$name} = new $className($this);
            }
            return $this->{$name};
        } else {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public static function decodeResponse(ResponseInterface $response) {
        return \GuzzleHttp\json_decode((string)$response->getBody());
    }

    /**
     * @return ClientInterface
     */
    public function getClient() : ClientInterface
    {
        if(!$this->client) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return Api
     */
    public function setClient(ClientInterface $client) : Api
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Returns the latest response
     *
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface
    {
        return $this->response;
    }

    /**
     * Sets request options for the next request
     *
     * @param array $requestOptions
     * @return Api
     */
    public function setRequestOptions(array $requestOptions) : Api
    {
        $this->requestOptions = $requestOptions;
        return $this;
    }

    /**
     * Sets default request options
     *
     * @param array $defaultRequestOptions
     * @return Api
     */
    public function setDefaultRequestOptions(array $defaultRequestOptions) : Api
    {
        $this->defaultRequestOptions = $defaultRequestOptions;
        return $this;
    }
}