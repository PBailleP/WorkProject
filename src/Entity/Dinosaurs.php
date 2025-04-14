<?php

namespace App\Entity;

use App\Repository\DinosaursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DinosaursRepository::class)]
class Dinosaurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $height = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isLookingCool = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastSeen = null;

    #[ORM\ManyToOne(inversedBy: 'dinosaurs')]
    private ?Period $period = null;

    #[ORM\ManyToOne(inversedBy: 'dinosaurs')]
    private ?Species $species = null;

    /**
     * @var Collection<int, Scientist>
     */
    #[ORM\ManyToMany(targetEntity: Scientist::class, inversedBy: 'dinosaurs')]
    private Collection $scientists;

    public function __construct()
    {
        $this->scientists = new ArrayCollection();
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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function isLookingCool(): ?bool
    {
        return $this->isLookingCool;
    }

    public function setIsLookingCool(?bool $isLookingCool): static
    {
        $this->isLookingCool = $isLookingCool;

        return $this;
    }

    public function getLastSeen(): ?\DateTimeInterface
    {
        return $this->lastSeen;
    }

    public function setLastSeen(?\DateTimeInterface $lastSeen): static
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): static
    {
        $this->period = $period;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): static
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return Collection<int, Scientist>
     */
    public function getScientists(): Collection
    {
        return $this->scientists;
    }

    public function addScientist(Scientist $scientist): static
    {
        if (!$this->scientists->contains($scientist)) {
            $this->scientists->add($scientist);
        }

        return $this;
    }

    public function removeScientist(Scientist $scientist): static
    {
        $this->scientists->removeElement($scientist);

        return $this;
    }
}
