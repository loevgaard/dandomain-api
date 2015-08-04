<?php
namespace Dandomain\Api\Endpoint;

class Settings extends Endpoint {
    public function getSites() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getCountries() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getCurrencies() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getPaymentMethods() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getShippingMethods() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getCompanyInfo() {
        throw new \RuntimeException('Should be implemented');
    }
}