<?php
namespace Loevgaard\Dandomain\Api\Client;

use Assert\Assert;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Loevgaard\Dandomain\Api\Exception\EncodeJsonException;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Response\Response;
use Loevgaard\Dandomain\Api\Response\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use function Loevgaard\Dandomain\Api\encodeJson;

class Client
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
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * This is the last request
     *
     * @var PsrRequestInterface|null
     */
    protected $request;

    /**
     * This is the last PSR response (differs from the response returned form the doRequest method)
     *
     * @var PsrResponseInterface|null
     */
    protected $response;

    public function __construct(string $host, string $apiKey, array $plugins = [], HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $host = rtrim($host, '/');

        Assert::that($host)->url('$host is not a valid URL');
        Assert::that($apiKey)->length(36, '$apiKey is not a valid api key. It must be 36 characters');

        $this->host = $host;
        $this->apiKey = $apiKey;

        $plugins[] = new ErrorPlugin();
        $this->httpClient = new PluginClient($httpClient ?: HttpClientDiscovery::find(), $plugins);
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws EncodeJsonException
     */
    public function doRequest(RequestInterface $request) : ResponseInterface
    {
        // resetting last request and response
        $this->request = null;
        $this->response = null;

        // replace the {KEY} placeholder with the api key
        $url = $this->host . str_replace('{KEY}', $this->apiKey, $request->getUri());

        // set headers
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $body = null;
        if (!empty($request->getBody())) {
            $body = encodeJson($request->getBody());
        }

        // create request
        // @todo this is not necessarily the real request, since it can be manipulated by plugins, figure out a way to retrieve the correct one
        $this->request = $this->requestFactory->createRequest($request->getMethod(), $url, $headers, $body);

        // send request
        $this->response = $this->httpClient->sendRequest($this->request);

        $responseClass = $request->getResponseClass();

        return $responseClass($this->response, $request);
    }

    /**
     * @return null|PsrRequestInterface
     */
    public function getRequest() : PsrRequestInterface
    {
        return $this->request;
    }

    /**
     * @return null|PsrResponseInterface
     */
    public function getResponse() : PsrResponseInterface
    {
        return $this->response;
    }
}
