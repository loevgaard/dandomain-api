<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class SetTrackNumberRequest extends BoolRequest
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $trackingNumber;

    public function __construct(int $orderId, string $trackingNumber)
    {
        Assert::that($orderId)->greaterThan(0, 'The orderId must be positive');
        Assert::that($trackingNumber)->minLength(1, 'The trackingNumber must not be empty');

        $this->orderId = $orderId;
        $this->trackingNumber = $trackingNumber;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetTrackNumber/%d?tracknumber=%s',
            $this->orderId,
            rawurlencode($this->trackingNumber)
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
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }
}
