<?php

namespace App\Form;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceClientEntityType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setRequired('class');
        $resolver->setDefaults([
            'compound'=>false,
            'multiple'=>true
        ]);
     

    }
public function buildForm(FormBuilderInterface $builder, array $options)
{
  
    $builder->addModelTransformer(new CallbackTransformer(
        function(Collection $value):array{
            return $value->map(fn($d)=>(string)$d->getId())->toArray();
        },
        function(array $ids):Collection{

        },

    ));
}
    
    public function buildView(FormView $view,FormInterface $form,array $option){

        dd($view);
        $view->vars['expanded'] = false;
        $view->vars['placeholder'] = null;
        $view->vars['placeholder_in_choices'] =false;
        $view->vars['multiple'] =true;
       
        $view->vars['preferred_choices'] =[];
        $view->vars['choices'] = $this->choices($form->getData());
        $view->vars['choice_translation_domain'] =true;
        $view->vars['full_name'] .='[]';

     

    }

    public function getBlockPrefix(){
        return 'choice';
    }

    private function choices(Collection $value){
        
        return $value
        
                ->map(fn($d)=>new ChoiceView($d, (string)$d->getId(),$d))
                ->toArray();
    }
        
    
}