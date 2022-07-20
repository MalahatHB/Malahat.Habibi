<?php

namespace App\Entity;

use App\Model\OwnedInterface;
use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Model\TimeLoggerInterface;
use App\Model\UserLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Model\UserLoggerTrait;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt")]
class Hotel implements TimeLoggerInterface, UserLoggerInterface, OwnedInterface
{
    use TimeLoggerTrait;
    use UserLoggerTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:3)]
    private $name;

    #[ORM\Column(type: 'string', length: 512)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:3)]
    private $address;

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Room::class, orphanRemoval: true)]
    private $rooms;


    #[ORM\Column(type: "datetime", nullable: true)]
    private $deletedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'hotels')]
    #[ORM\JoinColumn(nullable: false)]
    private $hotelOwner;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString()
    {
        return "{$this->name} ( {$this->address} )";
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

    public function getDeletedAt(){
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt){
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setHotel($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotel() === $this) {
                $room->setHotel(null);
            }
        }

        return $this;
    }

    public function getHotelOwner(): ?User
    {
        return $this->hotelOwner;
    }

    public function setHotelOwner(?User $hotelOwner): self
    {
        $this->hotelOwner = $hotelOwner;

        return $this;
    }

    public function getOwner()
    {
        // TODO: Implement getOwner() method.
    }
}