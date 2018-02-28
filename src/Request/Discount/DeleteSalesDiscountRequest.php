<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class DeleteSalesDiscountRequest extends Request
{
    /**
     * @var int
     */
    protected $id;

    public function __construct(int $id)
    {
        Assert::that($id)->greaterThan(0, 'The id must be positive');

        $this->id = $id;

        parent::__construct(RequestInterface::METHOD_DELETE, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/salesDiscount/%d', $this->id));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
