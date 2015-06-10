<?php
namespace Dandomain\Api;

class Api {
    protected $host;
    protected $apiKey;
    protected $query;
    protected $debug = false;

    public function __construct($host, $apiKey) {
        $this->host = rtrim($host, '/');
        $this->apiKey = $apiKey;
    }

    public function getOrders(\DateTime $dateStart, \DateTime $dateEnd) {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/GetByDateInterval?start=" . $dateStart->format('Y-m-d') . "&end=" . $dateEnd->format('Y-m-d');
        return $this->run();
    }
    public function getOrdersInModifiedInterval(\DateTime $dateStart, \DateTime $dateEnd) {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/GetByModifiedInterval?start=" . $dateStart->format('Y-m-d\TH:i:s') . "&end=" . $dateEnd->format('Y-m-d\TH:i:s');
        return $this->run();
    }
    public function getOrderStates() {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/OrderStates";
        return $this->run();
    }
    public function getProduct($productNumber, $siteId) {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/ProductService/{$this->apiKey}/" . rawurlencode($productNumber) . "/$siteId";
        return $this->run();
    }
    public function getSites() {
        $this->query = "/admin/WEBAPI/Endpoints/v1_0/SettingService/{$this->apiKey}/Sites";
        return $this->run();
    }

    protected function run() {
        $url = $this->host . $this->query;
        if($this->debug) {
            echo "URL: " . $url . "\n";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
        $content = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if($info['http_code'] != 200) {
            throw new \RuntimeException('HTTP ERROR. ' . htmlspecialchars($content), $info['http_code']);
        }

        return json_decode($content);
    }

    /**
     * @param boolean $debug
     * @return Api
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }
}