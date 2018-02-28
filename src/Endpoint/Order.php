<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

class Order extends Endpoint
{
    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @param int|null $orderStateId
     * @return int
     */
    public function countByModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd, int $orderStateId = null) : int
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart must be before $dateEnd');
        Assert::thatNullOr($orderStateId)->integer('$orderStateId must be an integer');

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CountByModifiedInterval?start=%s&end=%s',
            $dateStart->format('Y-m-d\TH:i:s'),
            $dateEnd->format('Y-m-d\TH:i:s')
        );

        if ($orderStateId) {
            $q .= sprintf('&orderstateid=%d', $orderStateId);
        }

        return (int)$this->master->doRequest('GET', $q);
    }

    /**
     * @param array|\stdClass $order
     * @return array
     */
    public function createOrder($order) : array
    {
        return (array)$this->master->doRequest('POST', '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}', $order);
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return array
     */
    public function getOrders(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) : array
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart must be before $dateEnd');

        return (array)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByDateInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d'),
                $dateEnd->format('Y-m-d')
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

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByCustomerNumber/%d', $customerNumber)
        );
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @param int $page
     * @param int $pageSize
     * @param int|null $orderStateId
     * @return array
     */
    public function getOrdersInModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd, int $page = 1, int $pageSize = 100, int $orderStateId = null) : array
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart must be before $dateEnd');
        Assert::that($page)->greaterThan(0, 'The $page has to be positive');
        Assert::that($pageSize)->greaterThan(0, 'The $pageSize has to be positive');
        Assert::thatNullOr($orderStateId)->integer('$orderStateId must be an integer');

        $q = sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByModifiedInterval?start=%s&end=%s&pageIndex=%d&pageSize=%d',
            $dateStart->format('Y-m-d\TH:i:s'),
            $dateEnd->format('Y-m-d\TH:i:s'),
            $page,
            $pageSize
        );

        if ($orderStateId) {
            $q .= sprintf('&orderstateid=%d', $orderStateId);
        }

        return (array)$this->master->doRequest('GET', $q);
    }

    /**
     * @return array
     */
    public function getOrderStates() : array
    {
        return (array)$this->master->doRequest('GET', '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/OrderStates');
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

        return (bool)$this->master->doRequest(
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

        return (bool)$this->master->doRequest(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderState/%d/%d', $orderId, $orderState)
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

        return (bool)$this->master->doRequest(
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
        Assert::that($orderId)->greaterThan(0, 'The $orderId has to be positive');

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
