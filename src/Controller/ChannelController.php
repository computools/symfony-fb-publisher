<?php

namespace App\Controller;

use App\Handler\Channel\ChannelListHandler;
use App\Handler\Channel\CreateChannelHandler;
use App\Handler\Channel\DeleteChannelHandler;
use App\Handler\Channel\GetAuthUrlHandler;
use App\Handler\Channel\GetChannelHandler;
use App\Request\Channel\CreateChannelRequest;
use App\Response\Channel\ChannelTransformer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class ChannelController
 * @package App\Controller
 *
 * @Rest\Route("/channel")
 */
class ChannelController extends BaseController
{
	/**
	 * @Rest\Get("/link")
	 */
	public function authLink(SessionInterface $session)
	{
		$session->start();
		return $this->json([
			'url' => $this->get(GetAuthUrlHandler::class)()
		]);
	}

	/**
	 * @Rest\Post("")
	 */
	public function addChannel(SessionInterface $session, CreateChannelRequest $request): JsonResponse
	{
		$session->start();
		$channel = $this->get(CreateChannelHandler::class)($request, $this->getUser());
		$this->flush();
		return $this->json(
			$this->item(
				$channel,
				new ChannelTransformer()
			),
			Response::HTTP_CREATED
		);
	}

	/**
	 * @Rest\Get("")
	 */
	public function getUsersChannels()
	{
		return $this->json(
			$this->collection(
				$this->get(ChannelListHandler::class)($this->getUser()),
				new ChannelTransformer()
			)
		);
	}

	/**
	 * @Rest\Get("/{channelId}")
	 */
	public function getChannel(int $channelId): JsonResponse
	{
		return $this->json(
			$this->item(
				$this->get(GetChannelHandler::class)($channelId, $this->getUser()),
				new ChannelTransformer()
			)
		);
	}

	/**
	 * @Rest\Delete("/{channelId}")
	 */
	public function deleteChannel(int $channelId): JsonResponse
	{
		$this->get(DeleteChannelHandler::class)($channelId, $this->getUser());
		$this->flush();
		return $this->json([], Response::HTTP_NO_CONTENT);
	}
}