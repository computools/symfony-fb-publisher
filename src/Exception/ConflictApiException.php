<?php

namespace App\Exception;

use SensioLabs\Security\Exception\HttpException;

/**
 * Class ConflictApiException
 * @package App\Exception
 */
class ConflictApiException extends HttpException
{
    const MESSAGE = 'Conflict';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}