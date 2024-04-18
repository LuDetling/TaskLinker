<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'projet_id')]
    private Collection $employe_id;

    public function __construct()
    {
        $this->employe_id = new ArrayCollection();
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

    /**
     * @return Collection<int, Employe>
     */
    public function getEmployeId(): Collection
    {
        return $this->employe_id;
    }

    public function addEmployeId(Employe $employeId): static
    {
        if (!$this->employe_id->contains($employeId)) {
            $this->employe_id->add($employeId);
        }

        return $this;
    }

    public function removeEmployeId(Employe $employeId): static
    {
        $this->employe_id->removeElement($employeId);
        return $this;
    }
}
