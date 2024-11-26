<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateVente = null;

    #[ORM\Column]
    private ?int $montantTotal = null;

    #[ORM\Column(enumType: Paiement::class)]
    private ?Paiement $modePaiement = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Vehicule $vehicule = null;

    #[ORM\ManyToOne(inversedBy: 'ventes')]
    private ?Client $clients = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVente(): ?\DateTimeImmutable
    {
        return $this->dateVente;
    }

    public function setDateVente(\DateTimeImmutable $dateVente): static
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    public function getMontantTotal(): ?int
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(int $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getModePaiement(): ?Paiement
    {
        return $this->modePaiement;
    }

    public function setModePaiement(Paiement $modePaiement): static
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): static
    {
        $this->clients = $clients;

        return $this;
    }
}
