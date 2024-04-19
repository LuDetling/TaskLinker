<?php

namespace App\Entity;

use App\Repository\CreneauRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreneauRepository::class)]
class Creneau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Employe $employe_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?tache $tache_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getEmployeId(): ?Employe
    {
        return $this->employe_id;
    }

    public function setEmployeId(?Employe $employe_id): static
    {
        $this->employe_id = $employe_id;

        return $this;
    }

    public function getTacheId(): ?tache
    {
        return $this->tache_id;
    }

    public function setTacheId(?tache $tache_id): static
    {
        $this->tache_id = $tache_id;

        return $this;
    }
}
