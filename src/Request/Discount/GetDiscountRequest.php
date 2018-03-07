<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DiscountIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\DiscountId;

abstract class GetDiscountRequest extends ObjectRequest
{
    use DiscountIdTrait;

    /**
     * @var string
     */
    protected $type;

    public function __construct(DiscountId $discountId, string $type)
    {
        Assert::that($type)->choice(DiscountType::getTypes());

        $this->discountId = $discountId;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%s', $this->type, $this->discountId));
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
