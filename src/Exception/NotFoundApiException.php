<?php

namespace App\Exception;

use SensioLabs\Security\Exception\HttpException;

/**
 * Class ConflictApiException
 * @package App\Exception
 */
class NotFoundApiException extends HttpException
{
    const MESSAGE = 'Not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}