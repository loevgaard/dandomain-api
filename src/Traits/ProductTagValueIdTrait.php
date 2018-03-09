<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\ProductTagValueId;

trait ProductTagValueIdTrait
{
    /**
     * @var ProductTagValueId
     */
    protected $productTagValueId;

    /**
     * @return ProductTagValueId
     */
    public function getProductTagValueId(): ProductTagValueId
    {
        return $this->productTagValueId;
    }
}
