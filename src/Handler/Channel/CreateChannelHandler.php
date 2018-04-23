<?php

namespace App\Handler\Channel;

use App\Entity\Channel;
use App\Entity\User;
use App\Exception\Channel\ChannelAlreadyExistsException;
use App\Request\Channel\CreateChannelRequest;
use App\Service\Facebook\DefaultFacebookService;
use App\Service\Factory\FacebookServiceFactory;

/**
 * Class CreateChannelHandler
 * @package App\Handler\Channel
 */
class CreateChannelHandler extends AbstractChannelHandler
{
	public function __invoke(CreateChannelRequest $request, User $user): Channel
	{
		/**
		 * @var DefaultFacebookService $service
		 */
		$service = $this->container->get(FacebookServiceFactory::class)->buildService();
		$accessToken = $service->getTokenByCode($request->get('code'));
		$clientInfo = $service->getClientData($accessToken);

		/**
		 * @var Channel $channel
		 */
		if ($channel = $this->channelRepository->findOneBy([
			'facebookId' => $clientInfo['id']
		])) {
			if ($user !== $channel->getUser()) {
				throw new ChannelAlreadyExistsException();
			}
			$channel->setUpdatedAt(new \DateTime());
		} else {
			$channel = new Channel();
			$channel->setFacebookId($clientInfo['id']);
			$channel->setUser($user);
			$channel->setCreatedAt(new \DateTime());
			$channel->setUpdatedAt(new \DateTime());
		}

		$channel->setAccessToken($accessToken->getValue());
		$channel->setExpiresAt($accessToken->getExpiresAt());

		$this->channelRepository->save($channel);
		return $channel;
	}
}