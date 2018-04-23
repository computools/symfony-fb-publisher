<?php

namespace App\Handler\Channel;

use App\Entity\Channel;
use App\Repository\ChannelRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractChannelHandler
 * @package App\Handler\Channel
 */
abstract class AbstractChannelHandler
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * @var ChannelRepository
	 */
	protected $channelRepository;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->channelRepository = $container->get('doctrine')->getRepository(Channel::class);
	}
}