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
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return Response
     */
    public function getOrders(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) {
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
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return int
     */
    public function countByModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) {
        return (int)((string)$this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CountByModifiedInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        )->getBody());
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return Response
     */
    public function getOrdersInModifiedInterval (\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd, $page = 1, $pageSize = 100) {
        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s&pageIndex=%d&pageSize=%d',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s'),
                $page,
                $pageSize
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

    /******************
     * Helper methods *
     *****************/
    /**
     * Will copy an order based on the order id
     * If the $orderLines is empty, it will also copy the order lines
     * If the $orderState is > 0, the method will update the order state
     * If $completeOrder is true, the method will also complate the order, otherwise it will be marked as incomplete by default
     * Returns the new order id
     *
     * @param int $orderId
     * @param array $orderLines
     * @param int $orderState
     * @param boolean $completeOrder
     * @return int
     */
    public function copyOrder($orderId, array $orderLines = [], $orderState = 0, $completeOrder = true) {
        $order = \GuzzleHttp\json_decode($this->getOrder($orderId)->getBody()->getContents());

        $data = [
            'siteId'            => $order->siteId,
            'altDeliveryInfo'   => null,
            'currencyCode'      => $order->currencyCode,
            'customerId'        => $order->customerInfo->id,
            'paymentId'         => $order->paymentInfo->id,
            'shippingId'        => $order->shippingInfo->id,
            'orderLines'        => $order->orderLines
        ];

        if(!empty($orderLines)) {
            $data['orderLines'] = $orderLines;
        }

        $res = \GuzzleHttp\json_decode($this->createOrder($data)->getBody()->getContents());

        $newOrderId = (int)$res->id;

        if($completeOrder) {
            $this->completeOrder($newOrderId);
        }

        if($orderState) {
            $this->setOrderState($newOrderId, $orderState);
        }

        return $newOrderId;
    }
}