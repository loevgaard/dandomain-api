<?php
namespace Loevgaard\Dandomain\Api\Traits;

trait ContextTrait
{
    /**
     * @var array
     */
    protected $context;

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
