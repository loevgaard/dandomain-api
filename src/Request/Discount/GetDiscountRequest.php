<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class GetDiscountRequest extends ObjectRequest
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    public function __construct(int $id, string $type)
    {
        Assert::that($id)->greaterThan(0, 'The id must be positive');
        Assert::that($type)->choice(DiscountType::getTypes());

        $this->id = $id;
        $this->type = $type;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d', $this->type, $this->id));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
