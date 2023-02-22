<?php

namespace App\Form;

use App\Entity\JuegoDeMesa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class JuegosdeMesaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre', TextType::class, array('data_class' => null))
            ->add('Editorial', TextType::class, array('data_class' => null))
            ->add('Anchura', TextType::class, array('data_class' => null))
            ->add('Longitud', TextType::class, array('data_class' => null))
            ->add('Caratula',FileType::class, array(
                'multiple'    => false,
                'data_class' => null,
                'required' => false,
                'attr' => array(
                    'accept' => 'image/*',
                )
            ))
            ->add('Tablero',FileType::class, array(
                'multiple'    => false,
                'data_class' => null,
                'required' => false,
                'attr' => array(
                    'accept' => 'image/*',
                )
            ))
            ->add('Min_jug', TextType::class, array('data_class' => null))
            ->add('Max_jug', TextType::class, array('data_class' => null));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JuegoDeMesa::class,
        ]);
    }
}
