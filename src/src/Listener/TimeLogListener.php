<?php

namespace App\Listener;

use App\Model\TimeLoggableInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TimeLogListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof TimeLoggableInterface) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof TimeLoggableInterface) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}