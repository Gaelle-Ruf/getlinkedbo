<?php

namespace App\Form;

use App\Entity\Event;
use NumberFormatter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => "Nom",
            ])
            ->add('address', null, [
                'label' => "Lieu",
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])  
            ->add('picture', null, [
                'label' => "Visuel",
            ])
            ->add('description', null, [
                'label' => "Description",
            ])
            ->add('price', null, [
                'label' => "Rémunération",                
            ])
            ->add('duration', null, [
                'label' => "Durée de la prestation",
            ])
            ->add('email', EmailType::class, [
                'label' => "Contact",
            ])
            ->add('publishedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])      
            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('updatedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('user', null, [
                'label' => "Nom de l'organisateur",
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
            'data_class' => Event::class,
        ]);
    }
}
