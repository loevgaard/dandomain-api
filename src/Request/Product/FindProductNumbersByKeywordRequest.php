<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/FindProductNumbersByKeyword
 */
class FindProductNumbersByKeywordRequest extends CollectionRequest
{
    use SiteIdTrait;

    /**
     * @var string
     */
    protected $keyword;

    public function __construct(string $keyword, SiteId $siteId)
    {
        Assert::that($keyword)->minLength(1, 'Keyword must not be empty');

        $this->keyword = $keyword;
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductNumbersByKeyword/%s/%s',
            rawurlencode($keyword),
            $this->siteId
        ));
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }
}
