<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
        if(Crud::PAGE_EDIT == $pageName) {
            return [
                'nombre',
                'descripcion',
                'Fecha_evento'
            ];
        }

        if(Crud::PAGE_NEW == $pageName) {
            return [
                'nombre',
                'descripcion',
                'Fecha_evento',
            ];
        }


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

    
    public function configureActions(Actions $actions): Actions
    {

        return $actions
        // ...
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa-solid fa-plus')->setLabel('Añadir evento');
        })

        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fa-sharp fa-solid fa-pen-to-square')->setLabel('Editar evento');
        })

        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fa-solid fa-trash')->setLabel('Borrar evento');
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
