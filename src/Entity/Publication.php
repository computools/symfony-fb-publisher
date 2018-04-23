<?php

namespace App\Entity;

use App\Service\Facebook\FacebookPostResult;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publication
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\PublicationRepository")
 */
class Publication
{
	public function fillWithPublicationResult(FacebookPostResult $postResult)
	{
		$this->success = $postResult->getSuccess();
		$this->errorMessage = $postResult->getErrorMessage();
		$this->facebookId = $postResult->getPostId();
	}

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $channel;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="publications")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $post;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $success = false;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $errorMessage;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $facebookId;

	public function getId(): int
	{
		return $this->id;
	}

	public function getChannel(): Channel
	{
		return $this->channel;
	}

	public function setChannel(Channel $channel)
	{
		$this->channel = $channel;
	}

	public function getPost(): Post
	{
		return $this->post;
	}

	public function setPost(Post $post)
	{
		$this->post = $post;
	}

	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
	}

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

	public function setErrorMessage(?string $errorMessage)
	{
		$this->errorMessage = $errorMessage;
	}

	public function getFacebookId(): ?string
	{
		return $this->facebookId;
	}

	public function setFacebookId(?string $facebookId)
	{
		$this->facebookId = $facebookId;
	}
}