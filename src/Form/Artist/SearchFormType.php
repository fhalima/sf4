<?php

namespace App\Form\Artist;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //création du formulaire et validation

        $builder
            ->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'help'=>'Nom de votre artiste favori.','constraints'=>[new NotBlank(['message'=>'Veuillez indiquer un nom'])]
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
