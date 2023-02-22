<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evento::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'Fecha_evento',
            'nombre',
            'descripcion'
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Eventos')
            ->setEntityLabelInSingular('...')
            ->setDateFormat('dd/MM/yyyy')
            ->setSearchFields(['Fecha_evento', 'nombre'])
            ->setDefaultSort(['Fecha_evento' => 'DESC'])
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(2)
            ->setPaginatorFetchJoinCollection(true)
            // ...
        ;
    }
}
