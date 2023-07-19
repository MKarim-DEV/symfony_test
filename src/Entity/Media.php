<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable:true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable:true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duration = null;

    #[ORM\ManyToMany(targetEntity: person::class, inversedBy: 'medias')]
    private Collection $staff;

    #[ORM\ManyToMany(targetEntity: genre::class, inversedBy: 'medias')]
    private Collection $genres;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?type $types = null;

    public function __construct()
    {
        $this->staff = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, person>
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaff(person $staff): static
    {
        if (!$this->staff->contains($staff)) {
            $this->staff->add($staff);
        }

        return $this;
    }

    public function removeStaff(person $staff): static
    {
        $this->staff->removeElement($staff);

        return $this;
    }

    /**
     * @return Collection<int, genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getTypes(): ?type
    {
        return $this->types;
    }

    public function setTypes(?type $types): static
    {
        $this->types = $types;

        return $this;
    }
}
