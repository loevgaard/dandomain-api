<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

class Order
{
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
