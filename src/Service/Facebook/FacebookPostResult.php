<?php

namespace App\Service\Facebook;

/**
 * Class FacebookPostResult
 * @package App\Service\Facebook
 */
class FacebookPostResult
{
	private $success;

	private $errorMessage = null;

	private $postId = null;

	public function getSuccess(): bool
	{
		return $this->success;
	}

	public function setSuccess(bool $success)
	{
		$this->success = $success;
	}

	public function getErrorMessage(): ?string
	{
		return $this->errorMessage;
	}

	public function setErrorMessage(string $errorMessage)
	{
		$this->errorMessage = $errorMessage;
	}

	public function getPostId(): ?string
	{
		return $this->postId;
	}

	public function setPostId(string $postId)
	{
		$this->postId = $postId;
	}
}