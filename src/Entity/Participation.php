<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="participation")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="participation")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"users_list", "user_detail"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
