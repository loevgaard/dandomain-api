# Dandomain API PHP Wrapper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

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
    $products = $api->productData->getDataProductsInModifiedInterval($dateStart, $dateEnd, $page, $pageSize);
}
```

[ico-version]: https://img.shields.io/packagist/v/loevgaard/dandomain-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/loevgaard/dandomain-api/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/loevgaard/dandomain-api.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/loevgaard/dandomain-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/loevgaard/dandomain-api
[link-travis]: https://travis-ci.org/loevgaard/dandomain-api
[link-scrutinizer]: https://scrutinizer-ci.com/g/loevgaard/dandomain-api/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/loevgaard/dandomain-api