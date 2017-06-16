<?php
namespace Dandomain\Api\Endpoint;

use Assert\Assert;

class ProductTag extends Endpoint {
    /**
     * @return int
     */
    public function getProductTagCount() {
        return (int)((string)$this->getMaster()->call(
            'GET','/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagCount'
        )->getBody());
    }

    /**
     * @param int $pageSize
     * @return int
     */
    public function getProductTagPageCount($pageSize) {
        Assert::that($pageSize)->integer()->greaterOrEqualThan(1);

        return (int)((string)$this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPageCount/%d', $pageSize)
        )->getBody());
    }

    /**
     * Will return a product tag page object
     *
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductTagService/help/operations/GetProductTagPage
     *
     * @param int $page
     * @param int $pageSize
     * @return \stdClass
     */
    public function getProductTagPage($page, $pageSize) {
        Assert::that($page)->integer()->greaterOrEqualThan(1);
        Assert::that($pageSize)->integer()->greaterOrEqualThan(1);

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPage/%d/%d', $page, $pageSize)
        )->getBody());
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/WEBAPI/Endpoints/v1_0/ProductTagService/help/operations/CreateProductTag
     *
     * @param array $tag
     * @return \stdClass
     */
    public function createProductTag($tag) {
        Assert::that($tag)->isArray();

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'POST',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}'),
            ['json' => $tag]
        )->getBody());
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/WEBAPI/Endpoints/v1_0/ProductTagService/help/operations/UpdateProductTag
     *
     * @param array $tag
     * @return \stdClass
     */
    public function updateProductTag($tag) {
        Assert::that($tag)->isArray();

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}'),
            ['json' => $tag]
        )->getBody());
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function deleteProductTag($id) {
        Assert::that($id)->integer()->greaterOrEqualThan(1);

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'DELETE',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/%d', $id)
        )->getBody()) === true;
    }

    /**
     * @param string $productNumber
     * @param int $tagValueId
     * @return bool
     */
    public function assignTagValueToProduct($productNumber, $tagValueId) {
        Assert::that($productNumber)->string();
        Assert::that($tagValueId)->integer()->greaterOrEqualThan(1);

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/AssignTagValueToProduct/%s/%d', rawurlencode($productNumber), $tagValueId)
        )->getBody()) === true;
    }
}