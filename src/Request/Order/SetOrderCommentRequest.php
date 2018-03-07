<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\OrderIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderId;

class SetOrderCommentRequest extends BoolRequest
{
    use OrderIdTrait;

    /**
     * @var string
     */
    protected $comment;

    public function __construct(OrderId $orderId, string $comment)
    {
        Assert::that($comment)->minLength(1, 'The comment must not be empty');

        $this->orderId = $orderId;
        $this->comment = $comment;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderComment/%s?comment=%s',
            $this->orderId,
            rawurlencode($this->comment)
        ));
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}
