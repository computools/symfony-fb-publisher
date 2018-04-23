<?php

namespace App\Exception\Channel;

use App\Exception\ConflictApiException;

/**
 * Class ChannelAlreadyExistsException
 * @package App\Exception\Channel
 */
class ChannelAlreadyExistsException extends ConflictApiException
{
	const MESSAGE = 'Channel has been already connected by another user';

	public function __construct($message = self::MESSAGE)
	{
		parent::__construct($message);
	}
}