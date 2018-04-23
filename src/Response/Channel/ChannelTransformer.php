<?php

namespace App\Response\Channel;

use App\Entity\Channel;
use League\Fractal\TransformerAbstract;

/**
 * Class ChannelTransformer
 * @package App\Response\Channel
 */
class ChannelTransformer extends TransformerAbstract
{
	public function transform(Channel $channel): array
	{
		return [
			'id' => $channel->getId(),
			'created_at' => $channel->getCreatedAt(),
			'updated_at' => $channel->getUpdatedAt(),
			'facebook_id' => $channel->getFacebookId(),
			'expires_at' => $channel->getExpiresAt()
		];
	}
}