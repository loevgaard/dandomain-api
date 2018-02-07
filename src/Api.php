<?php
namespace Loevgaard\Dandomain\Api;

use Assert\Assert;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @property Endpoint\Customer $customer
 * @property Endpoint\Discount $discount
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
     * These are the options used for the next request
     * After that request, these options are reset
     *
     * @var array
     */
    protected $options;

    /**
     * These are default options used for every request
     *
     * @var array
     */
    protected $defaultOptions;

    /**
     * These are the resolved options used in the last request
     *
     * @var array
     */
    protected $lastOptions;

    /*
     * These are endpoints in the Dandomain API
     */
    /**
     * @var Endpoint\Customer
     */
    protected $customer;

    /**
     * @var Endpoint\Discount
     */
    protected $discount;

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

    public function __construct(string $host, string $apiKey, array $defaultOptions = [])
    {
        $host = rtrim($host, '/');

        Assert::that($host)->url('`$host` is not a valid URL');
        Assert::that($apiKey)->length(36, '`$apiKey` is not a valid api key. It must be 36 characters');

        $this->host = $host;
        $this->apiKey = $apiKey;
        $this->options = [];
        $this->defaultOptions = $defaultOptions;
    }

    /**
     * This ensures lazy loading of the endpoint classes
     *
     * @param string $name
     * @return Endpoint\Endpoint
     */
    public function __get($name)
    {
        if (!property_exists(self::class, $name)) {
            throw new \InvalidArgumentException('The property `'.$name.'` does not exist on `'.self::class.'`');
        }

        if (!$this->{$name}) {
            $className = 'Loevgaard\\Dandomain\\Api\\Endpoint\\'.ucfirst($name);

            if (!class_exists($className)) {
                throw new \InvalidArgumentException('Class `'.$className.'` does not exist or could not be autoloaded');
            }

            $this->{$name} = new $className($this);
        }

        return $this->{$name};
    }

    /**
     * Will always return a JSON result contrary to Dandomains API
     * Errors are formatted as described here: http://jsonapi.org/format/#errors
     *
     * @param string $method
     * @param string $uri
     * @param array|\stdClass $body The body is sent as JSON
     * @param array $options
     * @return mixed
     */
    public function doRequest(string $method, string $uri, $body = null, array $options = [])
    {
        $parsedResponse = [];

        try {
            // merge all options
            // the priority is
            // 1. options supplied by the user
            // 2. options supplied by the method calling
            // 3. the default options
            $options = $this->resolveOptions($this->defaultOptions, $options, $this->options);

            if (!empty($body)) {
                $body = $this->objectToArray($body);
                Assert::that($body)->notEmpty('The body of the request cannot be empty');

                // the body will always override any other data sent
                $options['json'] = $body;
            }

            // save the resolved options
            $this->lastOptions = $options;

            // replace the {KEY} placeholder with the api key
            $url = $this->host . str_replace('{KEY}', $this->apiKey, $uri);

            // do request
            $this->response = $this->getClient()->request($method, $url, $options);

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
                $parsedResponse['errors'] = [];
                $parsedResponse['errors'][] = [
                    'status' => $this->response->getStatusCode(),
                    'detail' => 'See Api::$response for details'
                ];
            }
        } catch (GuzzleException $e) {
            $parsedResponse['errors'] = [];
            $parsedResponse['errors'][] = [
                'title' => 'Unexpected error',
                'detail' => $e->getMessage()
            ];
        } finally {
            // reset request options
            $this->options = [];
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
     * @param array $options
     * @return Api
     */
    public function setOptions(array $options) : Api
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Sets default request options
     *
     * @param array $defaultOptions
     * @return Api
     */
    public function setDefaultOptions(array $defaultOptions) : Api
    {
        $this->defaultOptions = $defaultOptions;
        return $this;
    }

    /**
     * @return array
     */
    public function getLastOptions(): array
    {
        return $this->lastOptions;
    }

    /**
     * Helper method to convert a \stdClass into an array
     *
     * @param $obj
     * @return array
     */
    protected function objectToArray($obj) : array
    {
        if ($obj instanceof \stdClass) {
            $obj = json_decode(json_encode($obj), true);
        }

        return (array)$obj;
    }

    protected function configureOptions(OptionsResolver $resolver) : void
    {
        $refl = new \ReflectionClass(RequestOptions::class);

        $resolver->setDefined(array_values($refl->getConstants()));

        $resolver->setDefaults([
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            RequestOptions::CONNECT_TIMEOUT => 15,
            RequestOptions::TIMEOUT => 60,
            RequestOptions::HTTP_ERRORS => false
        ]);
    }

    protected function resolveOptions(array ...$options) : array
    {
        $computedOptions = [];

        foreach ($options as $arr) {
            $computedOptions = array_replace_recursive($computedOptions, $arr);
        }

        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $options = $resolver->resolve($computedOptions);

        return $options;
    }
}
