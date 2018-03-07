<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetOrdersInModifiedIntervalRequest extends CollectionRequest
{
    /**
     * @var DateInterval
     */
    protected $interval;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $pageSize;

    /**
     * @var int
     */
    protected $orderState;

    public function __construct(DateInterval $interval, int $page = 1, int $pageSize = 100, int $orderState = 0)
    {
        Assert::that($page)->greaterThan(0, 'The page must be positive');
        Assert::that($pageSize)->greaterThan(0, 'The pageSize must be positive');
        Assert::that($orderState)->greaterOrEqualThan(0, 'The orderState must be positive');

        $this->interval = $interval;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->orderState = $orderState;

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s&pageIndex=%d&pageSize=%d',
            $this->interval->getStart()->format('Y-m-d\TH:i:s'),
            $this->interval->getEnd()->format('Y-m-d\TH:i:s'),
            $this->page,
            $this->pageSize
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
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getOrderState(): int
    {
        return $this->orderState;
    }
}
