<?php

namespace App\Entity;

use App\Repository\StatutRepository;
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
     * @var Collection<int, Tache>
     */
    #[ORM\OneToMany(targetEntity: Tache::class, mappedBy: 'statut')]
    private Collection $tache;

    public function __construct()
    {
        $this->tache = new ArrayCollection();
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
     * @return Collection<int, Tache>
     */
    public function getTache(): Collection
    {
        return $this->tache;
    }

    public function addTache(Tache $tache): static
    {
        if (!$this->tache->contains($tache)) {
            $this->tache->add($tache);
            $tache->setStatut($this);
        }

        return $this;
    }

    public function removeTache(Tache $tache): static
    {
        if ($this->tache->removeElement($tache)) {
            // set the owning side to null (unless already changed)
            if ($tache->getStatut() === $this) {
                $tache->setStatut(null);
            }
        }

        return $this;
    }
}
