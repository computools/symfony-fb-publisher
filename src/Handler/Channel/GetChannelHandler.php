<?php

namespace App\Handler\Channel;

use App\Entity\Channel;
use App\Entity\User;
use App\Exception\Channel\ChannelNotFoundException;

/**
 * Class GetChannelHandler
 * @package App\Handler\Channel
 */
class GetChannelHandler extends AbstractChannelHandler
{
	public function __invoke(int $channelId, User $user)
	{
		/**
		 * @var Channel $channel
		 */
		if (!$channel = $this->channelRepository->findOneBy([
			'id' => $channelId,
			'user' => $user
		])) {
			throw new ChannelNotFoundException();
		}

		return $channel;
	}
}