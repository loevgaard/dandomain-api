<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\CategoryId;

trait CategoryIdTrait
{
    /**
     * @var CategoryId
     */
    protected $categoryId;

    /**
     * @return CategoryId
     */
    public function getCategoryId(): CategoryId
    {
        return $this->categoryId;
    }
}
