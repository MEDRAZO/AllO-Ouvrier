<?php

namespace App\Form;

use App\Entity\Announces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control form-control-rounded',
                    'id' => 'input-6',
                    'placeholder' => "Title"],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control form-control-rounded',
                    'id' => 'input-6',
                    'placeholder' => "Description"],
            ])
            ->add('status', CheckboxType::class, [
                'required' => false,
                'label' => 'Online ?',
                'attr' => ['class' => 'form-control form-control-rounded',
                    'id' => 'input-6'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announces::class,
        ]);
    }
}
