<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'contact-label',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
            ]])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'contact-label',
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'contact-label',
                ],
                'required' => false,
            ])
            ->add('codePostal', NumberType::class, [
                'label' => 'Code Postal',
                'label_attr' => [
                    'class' => 'contact-label',
                ],
                'required' => false,
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet de contact',
                'label_attr' => [
                    'class' => 'contact-label',
                ],
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 5],
                'required' => false,
                'label_attr' => [
                    'class' => 'contact-label',
                ],
            ])
        ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
