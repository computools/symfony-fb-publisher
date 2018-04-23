<?php

namespace App\Exception\Publication;

use App\Exception\ConflictApiException;

/**
 * Class PublicationAlreadyExistsException
 * @package App\Exception\Publication
 */
class PublicationAlreadyExistsException extends ConflictApiException
{
	const MESSAGE = 'Post already published';

	public function __construct($message = self::MESSAGE)
	{
		parent::__construct($message);
	}
}