<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class CountByModifiedIntervalRequest extends IntRequest
{
    /**
     * @var DateInterval
     */
    protected $interval;

    /**
     * @var int
     */
    protected $orderState;

    public function __construct(DateInterval $interval, int $orderState = 0)
    {
        Assert::that($orderState)->greaterOrEqualThan(0);

        $this->interval = $interval;
        $this->orderState = $orderState;

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CountByModifiedInterval?start=%s&end=%s',
            $interval->getStart()->format('Y-m-d\TH:i:s'),
            $interval->getEnd()->format('Y-m-d\TH:i:s')
        );

        if ($this->orderState) {
            $q .= sprintf('&orderstateid=%d', $this->orderState);
        }

        parent::__construct(RequestInterface::METHOD_GET, $q);
    }

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval
    {
        return $this->interval;
    }

    /**
     * @return int
     */
    public function getOrderState(): int
    {
        return $this->orderState;
    }
}
