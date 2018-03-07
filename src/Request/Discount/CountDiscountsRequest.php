<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

abstract class CountDiscountsRequest extends IntRequest
{
    use SiteIdTrait;

    /**
     * @var string
     */
    protected $type;

    public function __construct(SiteId $siteId, string $type)
    {
        Assert::that($type)->choice(DiscountType::getTypes());

        // append plural
        $type .= 's';

        $this->siteId = $siteId;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%s', $this->type, $this->siteId));
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
