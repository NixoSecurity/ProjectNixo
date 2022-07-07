<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PartnerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom d\'entreprise',
                'required' => false
            ])
            ->add('url', TextType::class, [
                'label' => 'url d\'entreprise',
                'required' => false
            ])
            ->add('recommendation', TextareaType::class, [
                'label' => 'Text de recommendation',
                'required' => false
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prenom',
                'required' => false
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => false
            ])
            ->add('jobTitle', TextType::class, [
                'label' => 'Titre',
                'required' => false
            ])
            ->add('recoDate', DateType::class, [
                'label' => 'Date de recommendation',
                'required' => false,
                'input' => 'datetime_immutable',
                'widget' => 'single_text'  // <input type="date">
            ])
            // ->add('created_at', DateType::class, [
            //     'label' => 'Date du ajoute partenaire',
            //     'widget' => 'single_text',
            //     'input'  => 'datetime_immutable',
            //     'required' => False
            // ])
            ->add('coverFile', VichImageType::class, [
                'label' => 'Image de logo',
                'imagine_pattern' => 'vignette',
                'download_label' => false,
                'delete_label' => 'Cocher pour suprimer l\'image précédente',
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer le partenaire '
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
