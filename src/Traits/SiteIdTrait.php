<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\SiteId;

trait SiteIdTrait
{
    /**
     * @var SiteId
     */
    protected $siteId;

    /**
     * @return SiteId
     */
    public function getSiteId(): SiteId
    {
        return $this->siteId;
    }
}
