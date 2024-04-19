<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deadline = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Employe $employe_id = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'tache')]
    private Collection $projet_id;

    /**
     * @var Collection<int, Status>
     */
    #[ORM\OneToMany(targetEntity: Status::class, mappedBy: 'tache')]
    private Collection $status_id;

    /**
     * @var Collection<int, Etiquette>
     */
    #[ORM\ManyToMany(targetEntity: Etiquette::class, mappedBy: 'taches')]
    private Collection $etiquettes;

    public function __construct()
    {
        $this->projet_id = new ArrayCollection();
        $this->status_id = new ArrayCollection();
        $this->etiquettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): static
    {
        $this->deadline = $deadline;

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

    /**
     * @return Collection<int, Projet>
     */
    public function getProjetId(): Collection
    {
        return $this->projet_id;
    }

    public function addProjetId(Projet $projetId): static
    {
        if (!$this->projet_id->contains($projetId)) {
            $this->projet_id->add($projetId);
            $projetId->setTache($this);
        }

        return $this;
    }

    public function removeProjetId(Projet $projetId): static
    {
        if ($this->projet_id->removeElement($projetId)) {
            // set the owning side to null (unless already changed)
            if ($projetId->getTache() === $this) {
                $projetId->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Status>
     */
    public function getStatusId(): Collection
    {
        return $this->status_id;
    }

    public function addStatusId(Status $statusId): static
    {
        if (!$this->status_id->contains($statusId)) {
            $this->status_id->add($statusId);
            $statusId->setTache($this);
        }

        return $this;
    }

    public function removeStatusId(Status $statusId): static
    {
        if ($this->status_id->removeElement($statusId)) {
            // set the owning side to null (unless already changed)
            if ($statusId->getTache() === $this) {
                $statusId->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etiquette>
     */
    public function getEtiquettes(): Collection
    {
        return $this->etiquettes;
    }

    public function addEtiquette(Etiquette $etiquette): static
    {
        if (!$this->etiquettes->contains($etiquette)) {
            $this->etiquettes->add($etiquette);
            $etiquette->addTach($this);
        }

        return $this;
    }

    public function removeEtiquette(Etiquette $etiquette): static
    {
        if ($this->etiquettes->removeElement($etiquette)) {
            $etiquette->removeTach($this);
        }

        return $this;
    }
}
