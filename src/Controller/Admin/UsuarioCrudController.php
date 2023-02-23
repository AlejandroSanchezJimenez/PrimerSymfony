<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        if(Crud::PAGE_EDIT == $pageName) {
            return [
                'email',
                ChoiceField::new('roles')->setChoices(['ADMIN' => 'ROLE_ADMIN', 'USER' => 'ROLE_USER'])->allowMultipleChoices()
            ];
        }

        if(Crud::PAGE_NEW == $pageName) {
            return [
                'email',
                'nombre',
                'ape1',
                'ape2',
                'password',
                'nickname',
                'num_telegram'
            ];
        }

        return [
            EmailField::new('Email'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('fullname')->setLabel('Nombre completo'),
            TextField::new('Nickname'),
            NumberField::new('Num_telegram'),
            BooleanField::new('admin')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Usuarios')
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

        return $actions
        // ...
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setIcon('fa-solid fa-plus')->setLabel('Añadir usuario');
        })

        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            return $action->setIcon('fa-sharp fa-solid fa-pen-to-square')->setLabel('Editar usuario');
        })

        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            return $action->setIcon('fa-solid fa-trash')->setLabel('Borrar usuario');
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
