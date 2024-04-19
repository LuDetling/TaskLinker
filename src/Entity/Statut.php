<?php

namespace App\Entity;

use App\Repository\statutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'statut')]
    private Collection $projet_id;

    #[ORM\ManyToOne(inversedBy: 'statut_id')]
    private ?Tache $tache = null;

    public function __construct()
    {
        $this->projet_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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
            $projetId->setstatut($this);
        }

        return $this;
    }

    public function removeProjetId(Projet $projetId): static
    {
        if ($this->projet_id->removeElement($projetId)) {
            // set the owning side to null (unless already changed)
            if ($projetId->getstatut() === $this) {
                $projetId->setstatut(null);
            }
        }

        return $this;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(?Tache $tache): static
    {
        $this->tache = $tache;

        return $this;
    }
}
