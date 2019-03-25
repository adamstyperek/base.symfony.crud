<?php

namespace App\Form;

use App\Entity\TextContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TextContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, array('required' => true, 'label' => 'Opis', 'attr' => array('class' => 'wysiwyg')))
            ->add('contentEn', TextareaType::class, array('required' => true, 'label' => 'Opis (En)', 'attr' => array('class' => 'wysiwyg')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TextContent::class,
        ]);
    }
}
