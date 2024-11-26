<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $adrNumRue = null;

    #[ORM\Column(length: 255)]
    private ?string $adrRue = null;

    #[ORM\Column]
    private ?int $adrCP = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telephone = null;

    /**
     * @var Collection<int, Vente>
     */
    #[ORM\OneToMany(targetEntity: Vente::class, mappedBy: 'clients')]
    private Collection $ventes;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdrNumRue(): ?int
    {
        return $this->adrNumRue;
    }

    public function setAdrNumRue(int $adrNumRue): static
    {
        $this->adrNumRue = $adrNumRue;

        return $this;
    }

    public function getAdrRue(): ?string
    {
        return $this->adrRue;
    }

    public function setAdrRue(string $adrRue): static
    {
        $this->adrRue = $adrRue;

        return $this;
    }

    public function getAdrCP(): ?int
    {
        return $this->adrCP;
    }

    public function setAdrCP(int $adrCP): static
    {
        $this->adrCP = $adrCP;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): static
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes->add($vente);
            $vente->setClients($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): static
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getClients() === $this) {
                $vente->setClients(null);
            }
        }

        return $this;
    }
}
