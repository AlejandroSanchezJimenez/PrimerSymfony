<?php

namespace App\Form;

use App\Entity\JuegoDeMesa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JuegosdeMesaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre')
            ->add('Editorial')
            ->add('Anchura')
            ->add('Longitud')
            ->add('Caratula',FileType::class)
            ->add('Tablero',FileType::class)
            ->add('Min_jug')
            ->add('Max_jug')
            ->add('Crear',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JuegoDeMesa::class,
        ]);
    }
}
