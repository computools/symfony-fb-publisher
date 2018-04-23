<?php

namespace App\Exception\Channel;

use App\Exception\ForbiddenApiException;

/**
 * Class ChannelAccessTokenExpiredException
 * @package App\Exception\Channel
 */
class ChannelAccessTokenExpiredException extends ForbiddenApiException
{
	const MESSAGE = 'Channel access token expired';

	public function __construct($message = self::MESSAGE)
	{
		parent::__construct($message);
	}
}