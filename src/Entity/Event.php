<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"events_list", "event_detail"})
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"events_list", "event_detail"})
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"events_list", "event_detail"})
     * 
     */
    private $address;

    /**
     * @ORM\Column(type="datetime_immutable")
     * 
     * @Groups({"events_list", "event_detail"})
     * 
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     * 
     */
    private $picture;

    
    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $email;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $updatedAt;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="events")
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Style::class, inversedBy="events")
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $style;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="event")
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="event", orphanRemoval=true)
     * 
     * @Groups({"events_list", "event_detail"})
     */
    private $participation;


    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->style = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->participation = new ArrayCollection();

        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->publishedAt = new DateTimeImmutable();
    }

    public function __toString() {

        return $this->id . ' - ' . $this->name;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Style[]
     */
    public function getStyle(): Collection
    {
        return $this->style;
    }

    public function addStyle(Style $style): self
    {
        if (!$this->style->contains($style)) {
            $this->style[] = $style;
        }

        return $this;
    }

    public function removeStyle(Style $style): self
    {
        $this->style->removeElement($style);

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipation(): Collection
    {
        return $this->participation;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participation->contains($participation)) {
            $this->participation[] = $participation;
            $participation->setEvent($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participation->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getEvent() === $this) {
                $participation->setEvent(null);
            }
        }

        return $this;
    }
    
}
