<?php

namespace App\Form;

use App\Entity\Evento;
use App\Entity\Usuario;
use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventosType extends AbstractType
{
    private $juego;
    private $usuario;

    public function __construct(JuegoDeMesaRepository $juego, UsuarioRepository $usuario)
    {
        $this->juego = $juego;
        $this->usuario = $usuario;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre')
            ->add('Descripcion')
            ->add('Fecha_ini', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('Fecha_fin', DateType::class, [
                'widget' => 'single_text'
            ])
            // ->add('Juego', EntityType::class, [
            //     'class' => JuegoDeMesa::class,
            //     'choices' => $this->juego->findAll(),
            //     'choice_label' => 'Nombre',
            //     'label' => 'Juego del evento'
            // ])
            // ->add('Invitados', EntityType::class, [
            //     'class' => Usuario::class,
            //     'choices' => $this->usuario->findAll(),
            //     'choice_label' => 'Nickname',
            //     'label' => 'Invitados al evento',
            //     'multiple' => true
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
