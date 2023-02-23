<?php

namespace App\Controller\Admin;

use App\Entity\JuegoDeMesa;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JuegoDeMesaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JuegoDeMesa::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if(Crud::PAGE_EDIT == $pageName) {
            return [
                'nombre',
                'editorial',
                'anchura',
                'longitud',
                'maxjug',
                'minjug'
            ];
        }

        if(Crud::PAGE_NEW == $pageName) {
            return [
                'nombre',
                'editorial',
                'anchura',
                'longitud',
                'maxjug',
                'minjug'
            ];
        }

        return [
            'nombre',
                'editorial',
                'anchura',
                'longitud',
                'maxjug',
                'minjug'
        ];
    }

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

    
    public function configureActions(Actions $actions): Actions
    {

        return $actions
        // ...
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa-solid fa-plus')->setLabel('Añadir juego de mesa');
        })

        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fa-sharp fa-solid fa-pen-to-square')->setLabel('Editar juego de mesa');
        })

        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fa-solid fa-trash')->setLabel('Borrar juego de mesa');
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
