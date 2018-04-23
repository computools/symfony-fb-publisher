<?php

namespace App\Exception;

use SensioLabs\Security\Exception\HttpException;

/**
 * Class ConflictApiException
 * @package App\Exception
 */
class ForbiddenApiException extends HttpException
{
	const MESSAGE = 'Forbidden';

	public function __construct($message = self::MESSAGE)
	{
		parent::__construct($message);
	}
}