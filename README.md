# Dandomain API PHP Wrapper

This is a PHP wrapper for the [Dandomain](http://www.dandomain.dk) API. Internally it uses [Guzzle](http://docs.guzzlephp.org/) to send requests.

## Installation

```bash
composer require loevgaard/dandomain-api 
```

## Usage

```php
<?php
use Loevgaard\Dandomain\Api\Api;

$api = new Api('https://www.your-shop.dk', 'insert api key');

// Get modified products
$dateStart = \DateTime::createFromFormat('Y-m-d', '2018-01-01');
$dateEnd = new \DateTime();

$modifiedProductCount = $api->productData->countByModifiedInterval($dateStart, $dateEnd);
$pageSize = 100;
$pages = ceil($modifiedProductCount / $pageSize);

for($page = 1; $page <= $pages; $page++) {
    $products = $api->productData->getDataProductsInModifiedInterval($dateStart, $dateEnd, $page, $pageSize)
}
```