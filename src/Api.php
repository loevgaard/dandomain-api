<?php
namespace Loevgaard\Dandomain\Api;

use Assert\Assert;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Loevgaard\Dandomain\Api\Endpoint;
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
class Api
{
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

    public function __construct(string $host, string $apiKey)
    {
        $host = rtrim($host, '/');

        Assert::that($host)->url('`$host` is not a valid URL');
        Assert::that($apiKey)->length(36, '`$apiKey` is not a valid api key. It must be 36 characters');

        $this->host = $host;
        $this->apiKey = $apiKey;
        $this->requestOptions = [];

        // set the default request options
        $this->defaultRequestOptions = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            RequestOptions::CONNECT_TIMEOUT => 15,
            RequestOptions::TIMEOUT => 60,
            RequestOptions::HTTP_ERRORS => false
        ];
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
        if (property_exists(static::class, $name)) {
            if (!$this->{$name}) {
                $this->{$name} = new $className($this);
            }
            return $this->{$name};
        }
        $trace = debug_backtrace();
        trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE
            );
        return null;
    }

    /**
     * Will always return a JSON result contrary to Dandomains API
     * Errors are formatted as described here: http://jsonapi.org/format/#errors
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function doRequest(string $method, string $uri, array $options = [])
    {
        $parsedResponse = ['errors' => []];

        try {
            // and return an error object according to http://jsonapi.org/format/#errors

            // merge all options
            // the priority is
            // 1. options supplied by the user
            // 2. options supplied by the method calling
            // 3. the default options
            $options = array_merge($this->defaultRequestOptions, $options, $this->requestOptions);
            $url = $this->host . str_replace('{KEY}', $this->apiKey, $uri);

            // do request
            $this->response = $this->client->request($method, $url, $options);

            // parse response and create error object if the json decode throws an exception
            try {
                $parsedResponse = \GuzzleHttp\json_decode((string)$this->response->getBody(), true);
            } catch (\InvalidArgumentException $e) {
                $parsedResponse['errors'][] = [
                    'status' => $this->response->getStatusCode(),
                    'title' => 'JSON parse error',
                    'detail' => $e->getMessage()
                ];
            }

            if ($this->response->getStatusCode() !== 200) {
                $parsedResponse['errors'][] = [
                    'status' => $this->response->getStatusCode(),
                    'detail' => 'See Api::$response for details'
                ];
            }
        } catch (GuzzleException $e) {
            $parsedResponse['errors'][] = [
                'title' => 'Unexpected error',
                'detail' => $e->getMessage()
            ];
        } finally {
            // reset request options
            $this->requestOptions = [];

            // unset errors if empty
            if (isset($parsedResponse['errors']) && empty($parsedResponse['errors'])) {
                unset($parsedResponse['errors']);
            }
        }

        return $parsedResponse;
    }

    /**
     * @return ClientInterface
     */
    public function getClient() : ClientInterface
    {
        if (!$this->client) {
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
