<?php

namespace App\Form;

use App\Entity\AdminUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', 
                ChoiceType::class, 
                [   'choices' => [
                        'ROLE_ADMINUSER' => 'ROLE_ADMINUSER',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                    ],
                
                    'multiple' => true,
                    'expanded' => true   
                ]         
            )
            ->add('password')
            ->add('plainPassword',
                PasswordType::class,
                [
                    'mapped'=> false
                ]
            )

            ->add('firstname')
            ->add('lastname')  
            /* ->add('isVerified') */;

        /* display password field when adminuser is not created, if edit hide field */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            
            $adminuser = $event->getData();
            $form = $event->getForm();

            
            if ($adminuser->getId() === null) {
                $form->add('plainPassword', PasswordType::class, [
                    
                    'mapped' => false
                ]);
            }
            /* dd($adminuser, $form); */
        });
    }
    

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdminUser::class,
        ]);
    }
}
