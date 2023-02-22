<?php

namespace App\Controller\Admin;

use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserva::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('Dia_reserva'),
            TextField::new('horas')->setLabel('Horas'),
            TextField::new('nombrejuego')->setLabel('Juego reservado'),
            TextField::new('nombreUser')->setLabel('Usuario que reserva'),
            TextField::new('cancelacion')->setLabel('Reserva cancelada'),
            'Presentado'
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Reservas')
            ->setEntityLabelInSingular('...')
            ->setDateTimeFormat('dd/MM/yyyy')
            ->setSearchFields(['Dia_reserva', 'nombrejuego', 'nombreUser'])
            ->setDefaultSort(['Dia_reserva' => 'DESC'])
            ->setPaginatorPageSize(10)
            ->setPaginatorRangeSize(2)
            ->setPaginatorFetchJoinCollection(true)
            // ...
        ;
    }
}
