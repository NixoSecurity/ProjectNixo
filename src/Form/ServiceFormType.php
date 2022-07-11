<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du service',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                       'message' => 'Veuillez saisir une descripyion'
                    ])
                ]
            ])
            ->add('client',EntityType::class,[
                'class' => Client::class,
                'choice_label' =>'name',
                'label' => 'Type de client associé',
<<<<<<< HEAD
                'required' => True, 
                // 'multiple' =>true,
                'expanded' => true,

=======
                'required' => False,
                'mapped' => false,
>>>>>>> dev
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
//->add('clients',ServiceClientEntityType::class,[
    //     'class'=>Client::class
    // ])