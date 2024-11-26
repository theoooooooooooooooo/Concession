<?php

namespace App\Form;

use App\Entity\Vehicule;
use App\Entity\Categorie;
use App\Entity\EtatVehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('annee', null, [
                'widget' => 'single_text'
            ])
            ->add('kilometrage')
            ->add('prix')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Occasion' => EtatVehicule::OCCASION,
                    'Neuve' => EtatVehicule::NEUF,
                ],
                'choice_label' => fn($choice) => $choice->value, // Affiche la valeur de l'enum
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'constraints' => [new Image()],
                'mapped' => false,
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
