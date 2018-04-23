<?php

namespace App\Exception\User;

use App\Exception\ConflictApiException;

/**
 * Class UserAlreadyRegisteredException
 * @package App\Exception\User
 */
class UserAlreadyRegisteredException extends ConflictApiException
{
    const MESSAGE = 'User already registered';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}