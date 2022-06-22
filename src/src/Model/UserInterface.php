<?php

namespace App\Model;

interface UserInterface
{
    public function getCreatedBy();
    public function setCreatedBy(\Datetime $createdBy);
    public function getUpdatedBy();
    public function setUpdatedBy(\Datetime $updatedBy);
}