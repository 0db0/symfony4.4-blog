<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blog", inversedBy="comments")
     */
    private $blog;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): self
    {
        $this->blog = $blog;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->setApproved(true);
    }

    public function setUpdatedValue()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
