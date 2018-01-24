<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

class Order extends Endpoint
{
    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createOrder($obj) : array
    {
        Assert::that($obj)->notEmpty();

        return $this->master->doRequest(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}',
            ['json' => $obj]
        );
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return array
     */
    public function getOrders(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) : array
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart has be before $dateEnd');

        return $this->master->doRequest(
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
     * @return array
     */
    public function getOrder(int $orderId) : array
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');

        return $this->master->doRequest(
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
     * @return bool
     */
    public function deleteOrder(int $orderId) : bool
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');

        return $this->master->doRequest(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%d',
                $orderId
            )
        );
    }

    /**
     * @param int $orderId
     * @return bool
     */
    public function completeOrder(int $orderId) : bool
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');

        return $this->master->doRequest(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CompleteOrder/%d',
                $orderId
            )
        );
    }

    /**
     * @param int $customerNumber
     * @return array
     */
    public function getOrdersByCustomerNumber(int $customerNumber) : array
    {
        Assert::that($customerNumber)->greaterThan(0, 'The $customerNumber has to be positive');

        return $this->master->doRequest(
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
     * @return array
     */
    public function getOrdersInModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) : array
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart has be before $dateEnd');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        );
    }

    /**
     * @return array
     */
    public function getOrderStates() : array
    {
        return $this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/OrderStates'
        );
    }

    /**
     * @param int $orderId
     * @param string $comment
     * @return bool
     */
    public function setOrderComment(int $orderId, string $comment) : bool
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');
        Assert::that($comment)->minLength(1, 'The length of $comment has to be > 0');

        return $this->master->doRequest(
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
     * @return bool
     */
    public function setOrderState(int $orderId, int $orderState) : bool
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');
        Assert::that($orderState)->greaterThan(0, 'The $orderState has to be positive');

        return $this->master->doRequest(
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
     * @return bool
     */
    public function setTrackNumber(int $orderId, string $trackingNumber) : bool
    {
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');
        Assert::that($trackingNumber)->minLength(1, 'The length of $trackingNumber has to be > 0');

        return $this->master->doRequest(
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
     * If $completeOrder is true, the method will also complete the order, otherwise it will be marked as incomplete by default
     * Returns the new order
     *
     * @param int $orderId
     * @param array $orderLines
     * @param int $orderState
     * @param boolean $completeOrder
     * @return array
     */
    public function copyOrder(int $orderId, array $orderLines = [], int $orderState = 0, bool $completeOrder = true) : array
    {
        $order = $this->getOrder($orderId);

        $data = [
            'siteId'            => $order['siteId'],
            'altDeliveryInfo'   => null,
            'currencyCode'      => $order['currencyCode'],
            'customerId'        => $order['customerInfo']['id'],
            'paymentId'         => $order['paymentInfo']['id'],
            'shippingId'        => $order['shippingInfo']['id'],
            'orderLines'        => $order['orderLines']
        ];

        if (!empty($orderLines)) {
            $data['orderLines'] = $orderLines;
        }

        $newOrder = $this->createOrder($data);
        $newOrderId = (int)$newOrder['id'];

        if ($completeOrder) {
            $this->completeOrder($newOrderId);
        }

        if ($orderState) {
            $this->setOrderState($newOrderId, $orderState);
        }

        return $newOrder;
    }
}
