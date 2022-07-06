<?php

namespace App\Controller\Admin;

use App\Entity\Attraction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttractionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Attraction::class;
    }


    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('shortDescription'),
            TextField::new('fullDescription'),
            IntegerField::new('score'),
        ];
    }
}
