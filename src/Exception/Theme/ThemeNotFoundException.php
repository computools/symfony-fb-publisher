<?php

namespace App\Exception\Theme;

use App\Exception\NotFoundApiException;

/**
 * Class ThemeNotFoundException
 * @package App\Exception\Theme
 */
class ThemeNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Theme not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}