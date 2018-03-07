<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class SetOrderCommentRequest extends BoolRequest
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $comment;

    public function __construct(int $orderId, string $comment)
    {
        Assert::that($orderId)->greaterThan(0, 'The orderId must be positive');
        Assert::that($comment)->minLength(1, 'The comment must not be empty');

        $this->orderId = $orderId;
        $this->comment = $comment;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderComment/%d?comment=%s',
            $this->orderId,
            rawurlencode($this->comment)
        ));
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}
