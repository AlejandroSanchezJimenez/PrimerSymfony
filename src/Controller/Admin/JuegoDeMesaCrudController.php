<?php

namespace App\Controller\Admin;

use App\Entity\JuegoDeMesa;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JuegoDeMesaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JuegoDeMesa::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
