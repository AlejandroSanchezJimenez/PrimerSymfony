<?php

namespace App\Controller\Admin;

use App\Entity\Mesa;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MesaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mesa::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'id',
            TextField::new('Tamaño'),
            TextField::new('Posicion')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Mesas')
            ->setEntityLabelInSingular('...')
            ->setDateTimeFormat('dd/MM/yyyy')
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(2)
            ->setPaginatorFetchJoinCollection(true)
        ;
    }

    public function configureActions(Actions $actions): Actions
    {

        Action::new('Añadir','Añadir');

        return $actions;
    }
}
