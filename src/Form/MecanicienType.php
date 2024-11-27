<?php

namespace App\Form;

use App\Entity\Mecanicien;
use App\Entity\Specialiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MecanicienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('speciamiste', ChoiceType::class, [
                'choices' => [
                    'Carrosserie' => Specialiste::C,
                    'Frein' => Specialiste::F,
                    'Moteur' => Specialiste::M,
                ],
                'choice_label' => fn($choice) => $choice->value, // Affiche la valeur de l'enum
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mecanicien::class,
        ]);
    }
}
