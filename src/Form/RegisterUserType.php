<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => ['class' => 'border rounded-md']
            ])
            ->add('password', RepeatedType::class, [
                'first_options' => ['label' => 'Password', 'attr' => ['class' => 'border rounded-md']],
                'second_options' => ['label' => 'Confirme mot de passe', 'attr' => ['class' => 'border rounded-md']]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'border rounded-md']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'border rounded-md']
            ])
            ->add('picture', UrlType::class, [
                'label' => 'Image de profil',
                'attr' => ['class' => 'border rounded-md']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Inscription',
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
