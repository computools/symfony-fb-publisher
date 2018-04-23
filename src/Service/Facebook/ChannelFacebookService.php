<?php

namespace App\Service\Facebook;

use App\Entity\Channel;
use App\Entity\Post;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;

/**
 * Class ChannelFacebookService
 * @package App\Service\Facebook
 */
class ChannelFacebookService extends AbstractFacebookService
{
	/**
	 * @var Channel
	 */
	private $channel;

	protected function setFacebook(array $params): void
	{
		$params['default_access_token'] = $this->channel->getAccessToken();
		$this->facebook = new Facebook($params);
	}

	public function __construct(array $params, Channel $channel)
	{
		$this->channel = $channel;
		$this->setFacebook($params);
	}

	public function publishPost(Post $post): FacebookPostResult
	{
		$postResult = new FacebookPostResult();
		try {
			$response = $this->facebook->post(
				'/me/feed',
				[
					'message' => $post->getContent()
				],
				$this->channel->getAccessToken()
			);
			if ($response->isError()) {
				$postResult->setSuccess(false);
			} else {
				$postResult->setSuccess(true);
				$postResult->setPostId($response->getDecodedBody()['id']);
			}
		} catch (FacebookResponseException $exception) {
			$postResult->setSuccess(false);
			$postResult->setErrorMessage($exception->getMessage());
		}
		return $postResult;
	}

}