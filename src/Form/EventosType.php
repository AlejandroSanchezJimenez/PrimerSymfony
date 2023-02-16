<?php

namespace App\Form;

use App\Entity\Evento;
use App\Entity\Usuario;
use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('Fecha_Evento', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('JuegosDeEvento', EntityType::class, [
                'class' => JuegoDeMesa::class,
                'choices' => $this->juego->findAll(),
                'choice_label' => 'Nombre',
                'label' => 'Juegos del evento',
                'multiple' => true,
                'mapped' => false
            ])
            ->add('Participacion', EntityType::class, [
                'class' => Usuario::class,
                'choices' => $this->usuario->findAll(),
                'choice_label' => 'Nickname',
                'label' => 'Usuarios invitados',
                'multiple' => true,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
