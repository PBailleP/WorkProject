<?php

namespace App\Entity;

use App\Repository\ScientistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScientistRepository::class)]
class Scientist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $fieldOfStudy = null;

    /**
     * @var Collection<int, Dinosaurs>
     */
    #[ORM\ManyToMany(targetEntity: Dinosaurs::class, mappedBy: 'scientists')]
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

    public function getFieldOfStudy(): ?string
    {
        return $this->fieldOfStudy;
    }

    public function setFieldOfStudy(string $fieldOfStudy): static
    {
        $this->fieldOfStudy = $fieldOfStudy;

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
            $dinosaur->addScientist($this);
        }

        return $this;
    }

    public function removeDinosaur(Dinosaurs $dinosaur): static
    {
        if ($this->dinosaurs->removeElement($dinosaur)) {
            $dinosaur->removeScientist($this);
        }

        return $this;
    }
}
