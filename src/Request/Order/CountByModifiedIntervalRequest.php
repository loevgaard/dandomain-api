<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DateIntervalTrait;
use Loevgaard\Dandomain\Api\Traits\OrderStateIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderStateId;

class CountByModifiedIntervalRequest extends IntRequest
{
    use OrderStateIdTrait;
    use DateIntervalTrait;

    public function __construct(DateInterval $dateInterval, OrderStateId $orderStateId = null)
    {
        $this->dateInterval = $dateInterval;
        $this->orderStateId = $orderStateId;

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CountByModifiedInterval?start=%s&end=%s',
            $this->dateInterval->getStart()->format('Y-m-d\TH:i:s'),
            $this->dateInterval->getEnd()->format('Y-m-d\TH:i:s')
        );

        if ($this->orderStateId) {
            $q .= sprintf('&orderstateid=%s', $this->orderStateId);
        }

        parent::__construct(RequestInterface::METHOD_GET, $q);
    }
}
