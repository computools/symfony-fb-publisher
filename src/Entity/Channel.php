<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Channel
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\ChannelRepository")
 */
class Channel
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $user;

	/**
	 * @ORM\Column(type="string")
	 */
	private $facebookId;

	/**
	 * @ORM\Column(type="text")
	 */
	private $accessToken;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $updatedAt;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $expiresAt;

	public function getId()
	{
		return $this->id;
	}

	public function getUser(): User
	{
		return $this->user;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function getFacebookId()
	{
		return $this->facebookId;
	}

	public function setFacebookId($facebookId)
	{
		$this->facebookId = $facebookId;
	}

	public function getAccessToken()
	{
		return $this->accessToken;
	}

	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
	}

	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function getUpdatedAt(): \DateTime
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(\DateTime $updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	public function getExpiresAt(): \DateTime
	{
		return $this->expiresAt;
	}

	public function setExpiresAt(\DateTime $expiresAt)
	{
		$this->expiresAt = $expiresAt;
	}
}