<?php
namespace Loevgaard\Dandomain\Api\Traits;

trait PageSizeTrait
{
    /**
     * @var int
     */
    protected $pageSize;

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }
}
