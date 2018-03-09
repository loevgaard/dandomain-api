<?php
namespace Loevgaard\Dandomain\Api\Traits;

trait PageTrait
{
    /**
     * @var int
     */
    protected $page;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }
}
