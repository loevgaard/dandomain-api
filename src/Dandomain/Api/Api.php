<?php
namespace Dandomain\Api;

class Api {
    protected $host;
    protected $apiKey;
    protected $query;

    public function __construct($host, $apiKey) {
        $this->host = rtrim($host, '/');
        $this->apiKey = $apiKey;
    }

    /**
     * The equivalent to GetProduct
     */
    public function getProduct($productNumber, $siteId) {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/ProductService/{$this->apiKey}/" . rawurlencode($productNumber) . "/$siteId";
        return $this->run();
    }

    protected function run() {
        $url = $this->host . $this->query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}