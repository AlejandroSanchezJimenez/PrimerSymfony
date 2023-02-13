<?php

namespace App\Form;

use App\Entity\JuegosDeEvento;
use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class JuegosdeEventoType extends AbstractType
{
    private $juego;

    public function __construct(JuegoDeMesaRepository $juego)
    {
        $this->juego = $juego;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Juego', EntityType::class, [
                'class' => JuegoDeMesa::class,
                'choices' => $this->juego->findAll(),
                'choice_label' => 'Nombre',
                'label' => 'Juego del evento',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JuegosDeEvento::class,
        ]);
    }
}
