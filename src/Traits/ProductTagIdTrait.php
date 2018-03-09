<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\ProductTagId;

trait ProductTagIdTrait
{
    /**
     * @var ProductTagId
     */
    protected $productTagId;

    /**
     * @return ProductTagId
     */
    public function getProductTagId(): ProductTagId
    {
        return $this->productTagId;
    }
}
