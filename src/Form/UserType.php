<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', null, [
                'label' => "Artiste / Organisateur d'événement",
            ])
            ->add('name', null, [
                'label' => "Pseudo / Nom de l'établissement",
            ])
            ->add('firstname', null, [
                'label' => "Prénom",
            ])
            ->add('lastname', null, [
                'label' => "Nom",
            ])
            ->add('picture', null, [
                'label' => "Visuel",
            ])
            ->add('description', TextType::class, [
                'label' => "Description",
            ])
            /* ->add('schedule') */
            ->add('nbMembers', null, [
                'label' => "Membres composant le groupe",
            ])            
            ->add('address', null, [
                'label' => "Lieu",
            ])
            ->add('website', null, [
                'label' => "Site web",
            ])
            ->add('facebook', null, [
                'label' => "FaceBook",
            ])
            ->add('instagram', null, [
                'label' => "Instagram",
            ])         
            ->add('twitter', null, [
                'label' => "Twitter",
            ])   
            ->add('email', EmailType::class, [
                'label' => "Contact",
            ])
            /* ->add('password') */
            /* ->add('slug') */
            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('updatedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('category', null, [
                'label' => "Type d'établissement",
            ])
            ->add('style', null, [
                'label' => "Style de musique",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
