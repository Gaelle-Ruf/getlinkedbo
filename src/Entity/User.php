<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * 
     * @Groups({"users_list", "user_detail"})
     * @Groups({"comments_list", "comment_detail"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"users_list", "user_detail"})
     * @Groups({"events_list", "event_detail"})
     * @Groups({"comments_list", "comment_detail"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $lastname;


    /**
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $schedule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $nbMembers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_list", "user_detail"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="user", orphanRemoval=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="users")
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Style::class, inversedBy="users")
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $style;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     * 
     * @Groups({"users_list", "user_detail"})
     * 
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="user", orphanRemoval=true)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $participation;

    

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->style = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->participation = new ArrayCollection();
    }


    public function getRoles(): array 
    {$roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);}


    public function getSalt(){}    
    public function eraseCredentials(){}
    public function getUsername(){}
    public function getUseIdentifier(){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(?\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getNbMembers(): ?int
    {
        return $this->nbMembers;
    }

    public function setNbMembers(?int $nbMembers): self
    {
        $this->nbMembers = $nbMembers;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
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
            $participation->setUser($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participation->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }

        return $this;
    }

    
}
