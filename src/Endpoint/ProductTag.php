<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

class ProductTag extends Endpoint
{
    /**
     * @return int
     */
    public function getProductTagCount() : int
    {
        return (int)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagCount'
        );
    }

    /**
     * @param int $pageSize
     * @return int
     */
    public function getProductTagPageCount(int $pageSize = 100) : int
    {
        Assert::that($pageSize)->greaterThan(0, '$pageSize has to be positive');

        return (int)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPageCount/%d', $pageSize)
        );
    }

    /**
     * Will return a product tag page object
     *
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductTagService/help/operations/GetProductTagPage
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getProductTagPage(int $page = 1, int $pageSize = 100) : array
    {
        Assert::that($page)->greaterThan(0, '$page has to be positive');
        Assert::that($pageSize)->greaterThan(0, '$pageSize has to be positive');

        return $this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPage/%d/%d', $page, $pageSize)
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/WEBAPI/Endpoints/v1_0/ProductTagService/help/operations/CreateProductTag
     *
     * @param array $tag
     * @return array
     */
    public function createProductTag($tag) : array
    {
        $tag = $this->objectToArray($tag);
        Assert::that($tag)->notEmpty('$tag must not be empty');

        return (array)$this->master->doRequest(
            'POST',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}'),
            ['json' => $tag]
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/WEBAPI/Endpoints/v1_0/ProductTagService/help/operations/UpdateProductTag
     *
     * @param array $tag
     * @return array
     */
    public function updateProductTag($tag) : array
    {
        $tag = $this->objectToArray($tag);
        Assert::that($tag)->notEmpty('$tag must not be empty');

        return (array)$this->master->doRequest(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}'),
            ['json' => $tag]
        );
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function deleteProductTag(int $id) : bool
    {
        Assert::that($id)->greaterThan(0, '$id has to be positive');

        return (bool)$this->master->doRequest(
            'DELETE',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/%d', $id)
        );
    }

    /**
     * @param string $productNumber
     * @param int $tagValueId
     * @return bool
     */
    public function assignTagValueToProduct(string $productNumber, int $tagValueId) : bool
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        Assert::that($tagValueId)->greaterThan(0, '$tagValueId has to be positive');

        return (bool)$this->master->doRequest(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/AssignTagValueToProduct/%s/%d', rawurlencode($productNumber), $tagValueId)
        );
    }
}
