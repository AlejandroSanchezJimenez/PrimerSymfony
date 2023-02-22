<?php

namespace App\Form;

use App\Entity\JuegoDeMesa;
use App\Entity\Mesa;
use App\Entity\Reserva;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\MesaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservaType extends AbstractType
{
    private $juego;
    private $mesa;

    public function __construct(JuegoDeMesaRepository $juego, MesaRepository $mesa)
    {
        $this->juego = $juego;
        $this->mesa = $mesa;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $juego = new JuegoDeMesa;
        $juego = $this->juego->findOneBySomeField($_GET["idjuego"]);

        if ($this->mesa->findBySomeField($juego->getAnchura(), $juego->getLongitud())) {
            $builder
            ->add('Mesa', EntityType::class, [
                'class' => Mesa::class,
                'choices' => $this->mesa->findBySomeField($juego->getAnchura(), $juego->getLongitud()),
                'choice_label' => 'Id',
                'label' => 'Mesas disponibles'
            ])
            ->add('dia_reserva', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('Hora_entrada', TimeType::class, [
                'label' => 'Hora de entrada',
                'hours' => array(8, 9, 10, 11, 12, 13, 16, 17, 18, 19, 20),
                'minutes' => array(0, 30),
                'widget' => 'choice',
            ])
            ->add('Hora_salida', TimeType::class, [
                'label' => 'Hora de salida',
                'hours' => array(9, 10, 11, 12, 13, 14, 17, 18, 19, 20, 21),
                'minutes' => array(0, 30),
                'widget' => 'choice',
            ]);
        }
        else {
            
        }
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
