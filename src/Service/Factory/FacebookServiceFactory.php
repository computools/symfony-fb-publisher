<?php

namespace App\Service\Factory;

use App\Entity\Channel;
use App\Service\Facebook\ChannelFacebookService;
use App\Service\Facebook\DefaultFacebookService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class FacebookServiceFactory
 * @package App\Service\Factory
 */
class FacebookServiceFactory
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	private $params;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->params = $this->container->getParameter('facebook');
	}

	public function buildService(): DefaultFacebookService
	{
		return new DefaultFacebookService($this->params, $this->container->getParameter('APP_URL'));
	}

	public function buildFromChannel(Channel $channel): ChannelFacebookService
	{
		return new ChannelFacebookService($this->params, $channel);
	}
}