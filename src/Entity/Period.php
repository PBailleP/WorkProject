<?php

namespace App\Entity;

use App\Repository\PeriodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeriodRepository::class)]
class Period
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Dinosaurs>
     */
    #[ORM\OneToMany(targetEntity: Dinosaurs::class, mappedBy: 'period')]
    private Collection $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Dinosaurs>
     */
    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaurs $dinosaur): static
    {
        if (!$this->dinosaurs->contains($dinosaur)) {
            $this->dinosaurs->add($dinosaur);
            $dinosaur->setPeriod($this);
        }

        return $this;
    }

    public function removeDinosaur(Dinosaurs $dinosaur): static
    {
        if ($this->dinosaurs->removeElement($dinosaur)) {
            // set the owning side to null (unless already changed)
            if ($dinosaur->getPeriod() === $this) {
                $dinosaur->setPeriod(null);
            }
        }

        return $this;
    }
}
