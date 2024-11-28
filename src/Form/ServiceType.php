<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Mecanicien;
use App\Entity\Piece;
use App\Entity\Service;
use App\Entity\Statut;
use Doctrine\Migrations\Version\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('dateDemande', null, [
                'widget' => 'single_text'
            ])
            ->add('statut', ChoiceType::class,[
                'choices' => [
                    'Reçu' => Statut::R,
                    'En cours' => Statut::EC,
                    'Terminer' => Statut::T,
                ],
                'choice_label' => fn($choice) => $choice->value, // Affiche la valeur de l'enum
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => function (Client $client) {
                    return sprintf('%s %s', $client->getNom(), $client->getPrenom());
                },
                'label' => 'Client',
            ])
            ->add('mecaniciens', EntityType::class, [
                'class' => Mecanicien::class,
                'choice_label' => function (Mecanicien $mecanicien) {
                    return sprintf('%s %s', $mecanicien->getNom(), $mecanicien->getPrenom());
                },
                'label' => 'Mecanicien',
                'multiple' => true,
                'expanded' => true, // Utilise des cases à cocher
            ])
            ->add('pieces', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true, // Utilise des cases à cocher
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
