<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event extends Attraction
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $organizer;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $startDatetime;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endDatetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganizer(): ?User
    {
        return $this->organizer;
    }

    public function setOrganizer(?User $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(?\DateTimeInterface $startDatetime): self
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeInterface
    {
        return $this->endDatetime;
    }

    public function setEndDatetime(?\DateTimeInterface $endDatetime): self
    {
        $this->endDatetime = $endDatetime;

        return $this;
    }
}
