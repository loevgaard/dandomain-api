<?php
namespace Loevgaard\Dandomain\Api\Traits;

trait ProductNumberTrait
{
    /**
     * @var string
     */
    protected $productNumber;

    /**
     * @return string
     */
    public function getProductNumber(): string
    {
        return $this->productNumber;
    }
}
