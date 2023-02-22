<?php

namespace App\Controller\Admin;

use App\Entity\JuegoDeMesa;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Reservas')
            ->setEntityLabelInSingular('...')
            ->setDateTimeFormat('dd/MM/yyyy')
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(2)
            ->setPaginatorFetchJoinCollection(true)
            // ...
        ;
    }
}
