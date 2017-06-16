<?php
namespace Dandomain\Api\Endpoint;

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
        $this->assertInteger($pageSize, 'pageSize');

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
        $this->assertInteger($page, 'page');
        $this->assertInteger($pageSize, 'pageSize');

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPage/%d/%d', $page, $pageSize)
        )->getBody());
    }

    /**
     * @param $id
     * @return boolean
     */
    public function deleteProductTag($id) {
        $this->assertInteger($id, 'id');

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
        $this->assertString($productNumber, 'productNumber');
        $this->assertInteger($tagValueId, 'id');

        return \GuzzleHttp\json_decode((string)$this->getMaster()->call(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/AssignTagValueToProduct/%s/%d', rawurlencode($productNumber), $tagValueId)
        )->getBody()) === true;
    }
}