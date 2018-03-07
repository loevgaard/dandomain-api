<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\OrderIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderId;

class SetTrackNumberRequest extends BoolRequest
{
    use OrderIdTrait;

    /**
     * @var string
     */
    protected $trackingNumber;

    public function __construct(OrderId $orderId, string $trackingNumber)
    {
        Assert::that($trackingNumber)->minLength(1, 'The trackingNumber must not be empty');

        $this->orderId = $orderId;
        $this->trackingNumber = $trackingNumber;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetTrackNumber/%s?tracknumber=%s',
            $this->orderId,
            rawurlencode($this->trackingNumber)
        ));
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }
}
