<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetOrdersRequest extends CollectionRequest
{
    /**
     * @var DateInterval
     */
    protected $interval;

    public function __construct(DateInterval $interval)
    {
        $this->interval = $interval;

        parent::__construct(RequestInterface::METHOD_GET, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByDateInterval?start=%s&end=%s',
            $this->interval->getStart()->format('Y-m-d'),
            $this->interval->getEnd()->format('Y-m-d')
        ));
    }

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval
    {
        return $this->interval;
    }
}
