<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class, array(
                'attr' => array('maxlength' => 255)
                    ))
                ->add('content',TextareaType::class)
                ->add('status', ChoiceType::class, array(
                    'choices'  => array(
                        1 => 'Opublikuj',
                        2 => 'Niepublikuj',
                        3 => 'Opóźnij publikacje',
                    )))
                ->add('publish', DateTimeType::class, array(
                    'placeholder' => array(
                        'year' => 'Rok', 'month' => 'Miesiąc', 'day' => 'Dzień',
                        'hour' => 'Godzina', 'minute' => 'Minuta',
                    ),
                    'required' => false,
                    'label' => 'Data opóźnionej publikacji'
                    ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_post';
    }


}
