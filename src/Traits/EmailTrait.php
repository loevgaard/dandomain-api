<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\Email;

trait EmailTrait
{
    /**
     * @var Email
     */
    protected $email;

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }
}
