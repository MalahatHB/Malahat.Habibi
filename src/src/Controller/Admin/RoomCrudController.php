<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Room::class;
    }


    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id'),
            IntegerField::new('numberOfBeds'),
            BooleanField::new('isEmpty'),
        ];
    }
}
