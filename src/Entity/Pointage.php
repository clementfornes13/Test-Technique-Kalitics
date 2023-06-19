<?php

namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointageRepository::class)]
class Pointage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $chantier = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?string
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(string $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getChantier(): ?string
    {
        return $this->chantier;
    }

    public function setChantier(string $chantier): static
    {
        $this->chantier = $chantier;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

        return $this;
    }
}
