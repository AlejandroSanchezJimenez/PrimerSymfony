<?php

namespace App\Controller\Admin;

use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
        if(Crud::PAGE_EDIT == $pageName) {
            return [
                'Dia_reserva',
                'Hora_entrada',
                'Hora_salida',
                'Presentado',
                'Fecha_cancelacion'
            ];
        }

        if(Crud::PAGE_NEW == $pageName) {
            return [
                'Dia_reserva',
                'Hora_entrada',
                'Hora_salida',
                'Presentado',
                'Fecha_cancelacion'
            ];
        }

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
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ...
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa-solid fa-plus')->setLabel('Añadir reserva');
        })

        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fa-sharp fa-solid fa-pen-to-square')->setLabel('Editar reserva');
        })

        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fa-solid fa-trash')->setLabel('Borrar reserva');
        })

        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
            return $action->setIcon('fa-solid fa-floppy-disk')->setLabel('Guardar y seguir editando');
        })

        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
            return $action->setIcon('fa-solid fa-floppy-disk')->setLabel('Guardar');
        })

        ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
            return $action->setIcon('fa-solid fa-floppy-disk')->setLabel('Guardar y añadir más');
        })

        ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
            return $action->setIcon('fa-solid fa-floppy-disk')->setLabel('Guardar');
        }) 
    ;
    }
}
