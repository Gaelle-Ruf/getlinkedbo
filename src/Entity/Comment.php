<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"comments_list"})
     * 
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"comments_list"})
     * 
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     * 
     */
    private $comment;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"comments_list"})
     * 
     * @Groups({"comments_list", "comment_detail"})
     * 
     */
    private $rate;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"comments_list"})
     * 
     * @Groups({"comments_list", "comment_detail"})
     * 
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"comments_list"})
     * 
     * @Groups({"comments_list", "comment_detail"})
     * 
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="comment")
     * 
     * 
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comment")
     * 
     * 
     */
    private $user;


    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
