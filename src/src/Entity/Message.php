<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Model\TimeLoggerInterface;
use App\Model\UserLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Model\UserLoggerTrait;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message implements TimeLoggerInterface, UserLoggerInterface
{

    use UserLoggerTrait;
    use TimeLoggerTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(min:5)]
    private $message;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    private $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}