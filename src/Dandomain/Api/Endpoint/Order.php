<?php
namespace Dandomain\Api\Endpoint;

class Order extends Endpoint {
    public function createOrder() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getOrders(\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByDateInterval?start=%s&end=%s', $dateStart->format('Y-m-d'), $dateEnd->format('Y-m-d'))
        );
    }
    public function getOrder() {
        throw new \RuntimeException('Should be implemented');
    }
    public function deleteOrder() {
        throw new \RuntimeException('Should be implemented');
    }
    public function completeOrder() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getOrdersByCustomerNumber() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getOrdersInModifiedInterval () {
        throw new \RuntimeException('Should be implemented');
    }
    public function getOrderStates () {
        throw new \RuntimeException('Should be implemented');
    }
    public function setOrderComment  () {
        throw new \RuntimeException('Should be implemented');
    }
    public function setOrderState () {
        throw new \RuntimeException('Should be implemented');
    }
    public function setTrackNumber () {
        throw new \RuntimeException('Should be implemented');
    }
}