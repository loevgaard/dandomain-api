<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DateTrait;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/CustomerService/help/operations/GetCustomersCreatedSince
 */
class GetCustomersCreatedSinceRequest extends CollectionRequest
{
    use DateTrait;

    public function __construct(\DateTimeInterface $date)
    {
        Assert::that($date)->lessThan(new \DateTime(), 'The $date has to be in the past');

        $this->date = $date;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/CreatedSince?date=%s', $this->date->format('Y-m-d\TH:i:s')));
    }
}
