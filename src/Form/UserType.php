<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['id' => 'exampleInputName',
                    'class' => 'form-control input-shadow',
                    'placeholder' => 'Enter Your Username']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['id' => 'exampleInputEmailId',
                    'class' => 'form-control input-shadow',
                    'placeholder' => 'Enter Your Email']
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['id' => 'exampleInputPassword',
                    'class' => 'form-control input-shadow',
                    'placeholder' => 'Choose Password']
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
