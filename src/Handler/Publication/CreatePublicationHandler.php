<?php

namespace App\Handler\Publication;

use App\Entity\Channel;
use App\Entity\Post;
use App\Entity\Publication;
use App\Entity\User;
use App\Exception\Channel\ChannelAccessTokenExpiredException;
use App\Exception\Channel\ChannelNotFoundException;
use App\Exception\Post\PostNotFoundException;
use App\Exception\Publication\PublicationAlreadyExistsException;
use App\Repository\ChannelRepository;
use App\Repository\PostRepository;
use App\Repository\PublicationRepository;
use App\Service\Factory\FacebookServiceFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CreatePublicationHandler
 * @package App\Handler\Publication
 */
class CreatePublicationHandler
{
	/**
	 * @var PublicationRepository
	 */
	private $publicationRepository;

	/**
	 * @var ChannelRepository
	 */
	private $channelRepository;

	/**
	 * @var PostRepository
	 */
	private $postRepository;

	/**
	 * @var FacebookServiceFactory
	 */
	private $facebookServiceFactory;

	public function __construct(ContainerInterface $container)
	{
		$this->publicationRepository = $container->get('doctrine')->getRepository(Publication::class);
		$this->channelRepository = $container->get('doctrine')->getRepository(Channel::class);
		$this->postRepository = $container->get('doctrine')->getRepository(Post::class);
		$this->facebookServiceFactory = $container->get(FacebookServiceFactory::class);
	}

	public function __invoke(int $postId, int $channelId, User $user): Publication
	{
		/**
		 * @var Post $post
		 */
		if (!$post = $this->postRepository->findOneBy([
			'id' => $postId,
			'user' => $user
		])) {
			throw new PostNotFoundException();
		}

		/**
		 * @var Channel $channel
		 */
		if (!$channel = $this->channelRepository->findOneBy([
			'id' => $channelId,
			'user' => $user
		])) {
			throw new ChannelNotFoundException();
		}

		if ($channel->getExpiresAt() < new \DateTime()) {
			throw new ChannelAccessTokenExpiredException();
		}

		if ($publication = $this->publicationRepository->findOneBy([
			'success' => true,
			'channel' => $channel,
			'post' => $post
		])) {
			throw new PublicationAlreadyExistsException();
		}

		$facebookService = $this->facebookServiceFactory->buildFromChannel($channel);
		$postResult = $facebookService->publishPost($post);
		$publication = new Publication();
		$publication->setCreatedAt(new \DateTime());
		$publication->setChannel($channel);
		$publication->setPost($post);
		$publication->fillWithPublicationResult($postResult);
		$this->publicationRepository->save($publication);
		return $publication;
	}
}