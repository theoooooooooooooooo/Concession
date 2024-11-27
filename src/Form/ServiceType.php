<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Mecanicien;
use App\Entity\Piece;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('statut')
            ->add('client', EntityType::class, [
                'class' => Client::class,
'choice_label' => 'id',
            ])
            ->add('mecaniciens', EntityType::class, [
                'class' => Mecanicien::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('pieces', EntityType::class, [
                'class' => Piece::class,
'choice_label' => 'id',
'multiple' => true,
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
