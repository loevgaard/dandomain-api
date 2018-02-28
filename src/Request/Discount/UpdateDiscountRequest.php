<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class UpdateDiscountRequest extends Request
{
    /**
     * @var string
     */
    protected $type;

    public function __construct(array $discount, string $type)
    {
        Assert::that($discount)->notEmpty();
        Assert::that($type)->choice(DiscountType::getTypes());

        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s', $this->type), $discount);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
