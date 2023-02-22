<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
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
                'password',
                ChoiceField::new('roles')->setChoices(['ADMIN' => 'ROLE_ADMIN', 'USER' => 'ROLE_USER'])->allowMultipleChoices()
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
    
}
