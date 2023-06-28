<?php
namespace App\Entity;

use App\Repository\PointageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Chantier;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTime;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: PointageRepository::class)]
#[UniqueEntity(
    fields: ["utilisateur", "date"],
    message: "Vous ne pouvez pointer qu'une seule fois par jour pour un utilisateur."
)]
#[ORM\Table(name: "`pointage`")]
class Pointage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(targetEntity: Chantier::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chantier $chantier = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: "time")]
    private ?\DateTimeInterface $duree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    public function setChantier(?Chantier $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?DateTime
    {
        return $this->duree;
    }
    public function setDuree(?string $duree): self
    {
        $this->duree = $duree ? DateTime::createFromFormat('H:i', $duree) : null;
        return $this;
    }
    public function getDureeInMinutes(): ?int
    {
        return $this->duree ? ($this->duree->format('H') * 60) + $this->duree->format('i') : null;
    }

}
