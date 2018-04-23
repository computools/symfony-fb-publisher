<?php

namespace App\Handler\Channel;

use App\Entity\User;

/**
 * Class ChannelListHandler
 * @package App\Handler\Channel
 */
class ChannelListHandler extends AbstractChannelHandler
{
	public function __invoke(User $user)
	{
		return $this->channelRepository->findBy([
			'user' => $user
		]);
	}
}