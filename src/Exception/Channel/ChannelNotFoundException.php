<?php

namespace App\Exception\Channel;

use App\Exception\NotFoundApiException;

/**
 * Class ChannelNotFoundException
 * @package App\Exception\Channel
 */
class ChannelNotFoundException extends NotFoundApiException
{
	const MESSAGE = 'Channel not found';

	public function __construct($message = self::MESSAGE)
	{
		parent::__construct($message);
	}
}