<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->publications = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var ArrayCollection|Theme[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Theme")
     * @ORM\JoinTable(
     *      joinColumns={
     *          @ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="theme_id", referencedColumnName="id", onDelete="CASCADE")
     *      }
     * )
     */
    private $themes;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Publication", mappedBy="post")
	 */
    private $publications;

    public function getId(): int
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
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

    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): void
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
        }
    }

    public function removeTheme(Theme $theme): void
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
        }
    }

    public function getPublications(): Collection
	{
		return $this->publications;
	}
}