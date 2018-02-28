<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class CreateDiscountRequest extends Request
{
    /**
     * @var array
     */
    protected $discount;

    /**
     * @var string
     */
    protected $type;

    public function __construct(array $discount, string $type)
    {
        Assert::that($discount)->notEmpty();
        Assert::that($type)->choice(DiscountType::getTypes());

        $this->discount = $discount;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_POST, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s', $this->type), $this->discount);
    }

    /**
     * @return array
     */
    public function getDiscount(): array
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
