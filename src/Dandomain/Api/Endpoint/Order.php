<?php
namespace Dandomain\Api\Endpoint;

class Order extends Endpoint {
    public function createOrder() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getOrders() {
        throw new \RuntimeException('Should be implemented');
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