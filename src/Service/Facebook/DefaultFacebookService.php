<?php

namespace App\Service\Facebook;

use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;

/**
 * Class DefaultFacebookService
 * @package App\Service\Facebook
 */
class DefaultFacebookService extends AbstractFacebookService
{
	private $appId;

	private $appSecret;

	private $defaultGraphVersion;

	private $redirectUri;

	protected function setFacebook(array $params): void
	{
		$this->facebook = new Facebook($params);
		$this->appId = $params['app_id'];
		$this->appSecret = $params['app_secret'];
		$this->defaultGraphVersion = $params['default_graph_version'];
	}

	public function __construct(array $params, string $redirectUri)
	{
		$this->setFacebook($params);
		$this->redirectUri = $redirectUri;
	}

	public function getAuthUrl(): string
	{
		return $this->facebook->getRedirectLoginHelper()->getLoginUrl($this->redirectUri, [
			'publish_actions',
			'user_posts'
		]);
	}

	public function getTokenByCode(string $code): AccessToken
	{
		return $this->facebook->getRedirectLoginHelper()->getAccessToken($this->redirectUri);
	}

	public function getClientData(AccessToken $accessToken): array
	{
		$response = $this->facebook->get('/me', $accessToken);
		if ($response->isError()) {
			throw new FacebookResponseException($response);
		}
		return $response->getDecodedBody();
	}
}