<?php

namespace App\Form;

use App\Entity\Vente;
use App\Entity\Client;
use App\Entity\Paiement;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateVente', null, [
                'widget' => 'single_text',
                'label' => 'Date de la vente',
            ])
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'query_builder' => function (VehiculeRepository $repo) {
                    return $repo->createQueryBuilder('v')
                                ->where('v.etat != :Vendue')
                                ->setParameter('Vendue', 'Vendue');
                },
                'choice_label' => function (Vehicule $vehicule) {
                    return sprintf('%s %s (%s) - %d €',
                        $vehicule->getMarque(),
                        $vehicule->getModele(),
                        $vehicule->getCategorie()->getNom(),
                        $vehicule->getPrix()
                    );
                },
                'label' => 'Véhicule',
            ])
            ->add('clients', EntityType::class, [
                'class' => Client::class,
                // Combine nom et prénom dans le choix
                'choice_label' => function (Client $client) {
                    return sprintf('%s %s', $client->getNom(), $client->getPrenom());
                },
                'label' => 'Client',
            ])
            ->add('montantTotal', null, [
                'label' => 'Montant total (€)',
            ])
            ->add('modePaiement', ChoiceType::class, [
                'choices' => [
                    'Espèce' => Paiement::ESPECE,
                    'Chèque' => Paiement::CHEQUE,
                    'Carte Bancaire' => Paiement::CB,
                ],
                'choice_label' => fn($choice) => $choice->value, // Affiche la valeur de l'enum
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vente::class,
        ]);
    }
}
