<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, ['label' => 'Prénom', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un prénom',
                ]),
            ],])
            ->add('lastName', null, ['label' => 'Nom', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un nom',
                ]),
            ],])
            ->add('email', null, ['label' => 'Adresse email', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer une adresse email'
                ]),
            ],])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les termes et conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez les termes et conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }



    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('email')
    //         ->add('agreeTerms', CheckboxType::class, [
    //             'mapped' => false,
    //             'constraints' => [
    //                 new IsTrue([
    //                     'message' => 'You should agree to our terms.',
    //                 ]),
    //             ],
    //         ])
    //         ->add('plainPassword', PasswordType::class, [
    //             // instead of being set onto the object directly,
    //             // this is read and encoded in the controller
    //             'mapped' => false,
    //             'attr' => ['autocomplete' => 'new-password'],
    //             'constraints' => [
    //                 new NotBlank([
    //                     'message' => 'Please enter a password',
    //                 ]),
    //                 new Length([
    //                     'min' => 6,
    //                     'minMessage' => 'Your password should be at least {{ limit }} characters',
    //                     // max length allowed by Symfony for security reasons
    //                     'max' => 4096,
    //                 ]),
    //             ],
    //         ])
    //     ;
    // }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
