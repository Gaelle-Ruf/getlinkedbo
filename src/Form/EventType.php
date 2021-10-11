<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('date')
            ->add('picture')
            ->add('description')
            ->add('price')
            ->add('duration')
            ->add('email')
            ->add('publishedAt')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
            ->add('category')
            ->add('style')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
