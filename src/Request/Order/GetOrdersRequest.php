<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DateIntervalTrait;

class GetOrdersRequest extends CollectionRequest
{
    use DateIntervalTrait;

    public function __construct(DateInterval $dateInterval)
    {
        $this->dateInterval = $dateInterval;

        parent::__construct(RequestInterface::METHOD_GET, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByDateInterval?start=%s&end=%s',
            $this->dateInterval->getStart()->format('Y-m-d'),
            $this->dateInterval->getEnd()->format('Y-m-d')
        ));
    }
}
