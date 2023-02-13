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
    public function admin() {
        // if (in_array('ROLE_ADMIN',$this->getRoles())) {
        //     return true;
        // }
        // else {
        //     return false;
        // }
        return true;
    }

    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        if(Crud::PAGE_EDIT == $pageName) {
            return [
                'email',
                'nombre',
                ChoiceField::new('roles')->setChoices(['ADMIN' => 'ROLE_ADMIN', 'USER' => 'ROLE_USER'])->allowMultipleChoices()
            ];
        }

        return [
            EmailField::new('Email'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('Nombre'), 
            TextField::new('ape1'), 
            TextField::new('ape2'),
            TextField::new('Nickname'),
            NumberField::new('Num_telegram'),
            BooleanField::new('admin')
        ];
    }
    
}
