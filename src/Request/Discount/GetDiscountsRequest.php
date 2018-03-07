<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

abstract class GetDiscountsRequest extends CollectionRequest
{
    use SiteIdTrait;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $pageSize;

    /**
     * @var string
     */
    protected $type;

    public function __construct(SiteId $siteId, int $page, int $pageSize, string $type)
    {
        Assert::that($page)->greaterThan(0, 'page must be positive');
        Assert::that($pageSize)->greaterThan(0, 'pageSize must be positive');
        Assert::that($type)->choice(DiscountType::getTypes());

        // append plural
        $type .= 's';

        $this->siteId = $siteId;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%s/%d/%d', $this->type, $this->siteId, $this->page, $this->pageSize));
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
