<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email', EmailType::class, [
                'label' => 'Email:',
                'trim' => 'true'
            ])
            ->add('Nombre', TextType::class, [
                'label' => 'Nombre: ',
                'trim' => 'true'
            ])
            ->add('Ape1', TextType::class, [
                'label' => '1er apellido: ',
                'trim' => 'true'
            ])
            ->add('Ape2', TextType::class,[
                'label' => '2do Apellido: ',
                'required' => false,
                'trim' => 'true'
            ])
            ->add('Nickname', TextType::class, [
                'label' => 'Nickname: ',
                'trim' => 'true'
            ])
            ->add('num_telegram', TextType::class, [
                'label' => 'Telegram: ',
                'trim' => 'true',
                'constraints' => [
                    new Length([
                        'min' => 9,
                        'minMessage' => 'El número de telegram debe ser de 9 dígitos',
                        // max length allowed by Symfony for security reasons
                        'max' => 9,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'He leído y acepto las condiciones del servicio y la política de privacidad',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debe aceptar los términos y condiciones para realizar el registro.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Contraseña: ',
                'trim' => 'true',
                'attr' => ['autocomplete' => 'new-password'],
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor añada una contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'La contraseña debe ser de al menos {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 15,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
