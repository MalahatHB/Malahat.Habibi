<?php

namespace App\Listener;

use App\Entity\User;
use App\Model\UserInterface;
use App\Model\TimeLoggableInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TimeLogListener
{
    private TokenStorageInterface $tokenStorage;

    public function __construct(
        TokenStorageInterface $tokenStorage,
    ) {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $user = $this->tokenStorage->getToken()->getUser();

        if ($entity instanceof TimeLoggableInterface) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        }
        if ($entity instanceof UserInterface) {
            if($user instanceof User) {
                $entity->setCreatedBy($user);
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $user = $this->tokenStorage->getToken()->getUser();

        if ($entity instanceof TimeLoggableInterface) {
            $entity->setUpdatedAt(new \DateTime());
        }
        if ($entity instanceof UserInterface) {
            if($user instanceof User) {
                $entity->setUpdatedBy($user);
            }
        }
    }
}