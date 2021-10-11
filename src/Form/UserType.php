<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('name')
            ->add('firstname')
            ->add('lastname')
            ->add('picture')
            ->add('description')
            ->add('schedule')
            ->add('nbMembers')
            ->add('address')
            ->add('website')
            ->add('facebook')
            ->add('instagram')
            ->add('twitter')
            ->add('email')
            ->add('password')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('category')
            ->add('style')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
