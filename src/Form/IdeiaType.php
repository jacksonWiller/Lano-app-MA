<?php

namespace App\Form;

use App\Entity\Ideia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class IdeiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        ->add('titulo')

        ->add('descricao', TextareaType::class, [
            'attr' => ['class' => 'tinymce'],
        ])
        
        
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ideia::class,
        ]);
    }
}
