<?php

namespace App\Handler\Channel;

use App\Entity\User;
use App\Exception\Channel\ChannelNotFoundException;

/**
 * Class DeleteChannelHandler
 * @package App\Handler\Channel
 */
class DeleteChannelHandler extends AbstractChannelHandler
{
	public function __invoke(int $channelId, User $user): void
	{
		if (!$channel = $this->channelRepository->findOneBy([
			'id' => $channelId,
			'user' => $user
		])) {
			throw new ChannelNotFoundException();
		}

		$this->channelRepository->remove($channel);
	}
}