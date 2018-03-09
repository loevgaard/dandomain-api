<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\PagingTrait;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/WEBAPI/Endpoints/v1_0/ProductTagService/help/operations/UpdateProductTag
 */
class UpdateProductTagRequest extends ObjectRequest
{
    /**
     * @var array
     */
    protected $tag;

    public function __construct(array $tag)
    {
        $this->tag = $tag;

        parent::__construct(RequestInterface::METHOD_PUT, '/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}', $this->tag);
    }

    /**
     * @return array
     */
    public function getTag(): array
    {
        return $this->tag;
    }
}
