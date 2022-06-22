<?php

namespace App\Model;

interface TimeLoggableInterface
{
    public function setCreatedAt(\DateTimeImmutable $createdAt);

    public function setUpdatedAt(\DateTimeImmutable $updatedAt);
}