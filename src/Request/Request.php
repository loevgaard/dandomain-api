<?php
namespace Loevgaard\Dandomain\Api\Request;

use Assert\Assert;

abstract class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array
     */
    protected $body;

    public function __construct(string $method, string $uri, array $body = [])
    {
        Assert::that($method)->choice([
            RequestInterface::METHOD_GET,
            RequestInterface::METHOD_POST,
            RequestInterface::METHOD_PUT,
            RequestInterface::METHOD_PATCH,
            RequestInterface::METHOD_DELETE,
        ]);

        $this->method = $method;
        $this->uri = $uri;
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
