<?php

namespace App\Entity;

use App\Repository\ChantierRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ChantierRepository::class)]
class Chantier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $nom = null;


    #[ORM\Column(type: "string", length: 255)]
    private ?string $adresse = null;


    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\OneToMany(mappedBy: "chantier", targetEntity: Pointage::class)]
    private $pointages;

    public function __construct()
    {
        $this->pointages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }
    /**
     * @return Collection|Pointage[]
    */
    public function getPointages(): Collection
    {
        return $this->pointages;
    }
}