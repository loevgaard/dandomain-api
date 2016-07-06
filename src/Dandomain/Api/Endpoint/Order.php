<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;

class Order extends Endpoint {
    public function createOrder($obj) {
        return $this->getMaster()->call(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}',
            ['json' => $obj]
        );
    }

    /**
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Response
     */
    public function getOrders(\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByDateInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d'),
                $dateEnd->format('Y-m-d')
            )
        );
    }

    /**
     * @param int $orderId
     * @return Response
     */
    public function getOrder($orderId) {
        $this->assertInteger($orderId, '$orderId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%d',
                $orderId
            )
        );
    }

    /**
     * Deletes an order
     *
     * @param int $orderId
     * @return Response
     */
    public function deleteOrder($orderId) {
        $this->assertInteger($orderId, '$orderId');

        return $this->getMaster()->call(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%d',
                $orderId
            )
        );
    }

    /**
     * @param int $orderId
     * @return Response
     */
    public function completeOrder($orderId) {
        $this->assertInteger($orderId, '$orderId');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CompleteOrder/%d',
                $orderId
            )
        );
    }

    /**
     * @param int $customerNumber
     * @return Response
     */
    public function getOrdersByCustomerNumber($customerNumber) {
        $this->assertInteger($customerNumber, '$customerNumber');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByCustomerNumber/%d',
                $customerNumber
            )
        );
    }

    /**
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Response
     */
    public function getOrdersInModifiedInterval (\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        );
    }

    /**
     * @return Response
     */
    public function getOrderStates () {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/OrderStates'
        );
    }

    /**
     * @param int $orderId
     * @param string $comment
     * @return Response
     */
    public function setOrderComment($orderId, $comment) {
        $this->assertInteger($orderId, '$orderId');
        $this->assertString($comment, '$comment');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderComment/%d?comment=%s',
                $orderId,
                rawurlencode($comment)
            )
        );
    }

    /**
     * @param int $orderId
     * @param int $orderState
     * @return Response
     */
    public function setOrderState($orderId, $orderState) {
        $this->assertInteger($orderId, '$orderId');
        $this->assertInteger($orderState, '$orderState');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderState/%d/%d',
                $orderId,
                $orderState
            )
        );
    }

    /**
     * @param int $orderId
     * @param string $trackingNumber
     * @return Response
     */
    public function setTrackNumber($orderId, $trackingNumber) {
        $this->assertInteger($orderId, '$orderId');
        $this->assertString($trackingNumber, '$trackingNumber');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetTrackNumber/%d?tracknumber=%s',
                $orderId,
                rawurlencode($trackingNumber)
            )
        );
    }
}