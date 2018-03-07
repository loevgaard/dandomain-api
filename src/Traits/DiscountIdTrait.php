<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\DiscountId;

trait DiscountIdTrait
{
    /**
     * @var DiscountId
     */
    protected $discountId;

    /**
     * @return DiscountId
     */
    public function getDiscountId(): DiscountId
    {
        return $this->discountId;
    }
}
