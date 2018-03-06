<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class CountDiscountsRequest extends IntRequest
{
    /**
     * @var int
     */
    protected $siteId;

    /**
     * @var string
     */
    protected $type;

    public function __construct(int $siteId, string $type)
    {
        Assert::that($siteId)->greaterThan(0, 'The siteId must be positive');
        Assert::that($type)->choice(DiscountType::getTypes());

        // append plural
        $type .= 's';

        $this->siteId = $siteId;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d', $this->type, $this->siteId));
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
