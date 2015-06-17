<?php
namespace Dandomain\Api;

class Api {
    /**
     * Example: http://www.example.com
     *
     * @var string
     */
    protected $host;

    /**
     * The API key from your Dandomain admin
     *
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * Can be 'xml' or 'json'
     *
     * @var string
     */
    protected $contentType = 'json';

    /**
     * Whether the result should be saved in a file
     *
     * @var bool
     */
    protected $saveResult = false;

    /**
     * The directory to store any saved results
     *
     * @var string
     */
    protected $directory;

    /**
     * The file to save any results to
     *
     * @var string
     */
    protected $file;

    public function __construct($host, $apiKey) {
        $this->setHost($host);
        $this->setApiKey($apiKey);
    }

    public function getOrders(\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/GetByDateInterval?start=" . $dateStart->format('Y-m-d') . "&end=" . $dateEnd->format('Y-m-d'));
    }
    public function getOrdersInModifiedInterval(\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/GetByModifiedInterval?start=" . $dateStart->format('Y-m-d\TH:i:s') . "&end=" . $dateEnd->format('Y-m-d\TH:i:s'));
    }
    public function getOrderStates() {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/OrderService/{$this->apiKey}/OrderStates");
    }
    public function getProduct($productNumber, $siteId) {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/ProductService/{$this->apiKey}/" . rawurlencode($productNumber) . "/$siteId");
    }
    public function getProductsInModifiedInterval(\DateTime $dateStart, \DateTime $dateEnd, $siteId) {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/ProductService/{$this->apiKey}/GetByModifiedInterval/$siteId?start=" . $dateStart->format('Y-m-d\TH:i:s') . "&end=" . $dateEnd->format('Y-m-d\TH:i:s'));
    }
    public function getSites() {
        return $this->run("/admin/WEBAPI/Endpoints/v1_0/SettingService/{$this->apiKey}/Sites");
    }

    public function run($query) {
        $url = $this->host . $query;

        if($this->debug) {
            echo "URL: " . $url . "\n";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: " . $this->getAcceptHeader()));

        if($this->saveResult) {
            curl_setopt($ch, CURLOPT_FILE, $this->getSavePath());
        }

        $content = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if($info['http_code'] != 200) {
            throw new \RuntimeException('HTTP ERROR. ' . htmlspecialchars($content), $info['http_code']);
        }

        switch($this->contentType) {
            case 'json':
                return json_decode($content);
                break;
            case 'xml':
                return new \SimpleXMLElement($content);
                break;
        }
    }

    protected function getAcceptHeader() {
        if(stripos($this->contentType, 'json')) {
            return 'application/json';
        } else {
            return 'application/xml';
        }
    }

    protected function getSavePath() {
        if(is_null($this->directory)) {
            throw new \RuntimeException('No directory set.');
        }
        if(is_null($this->file)) {
            $this->file = 'DandomainApiResult' . date('YmdHis') . '-' . uniqid() . '.txt'; // using uniqid to avoid collissions
        }

        return $this->directory . DIRECTORY_SEPARATOR . $this->file;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Api
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return Api
     */
    public function setContentType($contentType)
    {
        $contentType = strtolower($contentType);

        if(!in_array($contentType, array('json', 'xml'))) {
            throw new \InvalidArgumentException('$contentType' . " can only be 'json' or 'xml'");
        }

        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
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

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Api
     */
    public function setHost($host)
    {
        $host = rtrim($host, '/');
        if(!filter_var($host, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('$host is not a valid URL');
        }
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return Api
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @return Api
     */
    public function setDirectory($directory)
    {
        $directory = rtrim($directory, '/\\');
        if(!is_dir($directory)) {
            throw new \InvalidArgumentException('$directory is not a valid directory');
        }
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return Api
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSaveResult()
    {
        return $this->saveResult;
    }

    /**
     * @param boolean $saveResult
     * @return Api
     */
    public function setSaveResult($saveResult)
    {
        $this->saveResult = $saveResult;
        return $this;
    }

}