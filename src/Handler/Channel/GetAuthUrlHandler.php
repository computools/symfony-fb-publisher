<?php

namespace App\Handler\Channel;

use App\Service\Factory\FacebookServiceFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GetAuthUrlHandler
 * @package App\Handler\Channel
 */
class GetAuthUrlHandler
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function __invoke()
	{
		return $this->container->get(FacebookServiceFactory::class)
			->buildService()
			->getAuthUrl();
	}
}