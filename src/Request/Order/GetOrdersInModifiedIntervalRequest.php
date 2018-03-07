<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DateIntervalTrait;
use Loevgaard\Dandomain\Api\Traits\OrderStateIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderStateId;

class GetOrdersInModifiedIntervalRequest extends CollectionRequest
{
    use DateIntervalTrait;
    use OrderStateIdTrait;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $pageSize;

    public function __construct(DateInterval $dateInterval, int $page = 1, int $pageSize = 100, OrderStateId $orderStateId = null)
    {
        Assert::that($page)->greaterThan(0, 'The page must be positive');
        Assert::that($pageSize)->greaterThan(0, 'The pageSize must be positive');

        $this->dateInterval = $dateInterval;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->orderStateId = $orderStateId;

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s&pageIndex=%d&pageSize=%d',
            $this->dateInterval->getStart()->format('Y-m-d\TH:i:s'),
            $this->dateInterval->getEnd()->format('Y-m-d\TH:i:s'),
            $this->page,
            $this->pageSize
        );

        if ($this->orderStateId) {
            $q .= sprintf('&orderstateid=%s', $this->orderStateId);
        }

        parent::__construct(RequestInterface::METHOD_GET, $q);
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
}
