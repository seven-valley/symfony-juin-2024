<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 4)]
    private ?string $annee = null;

    /**
     * @var Collection<int, Categ>
     */
    #[ORM\ManyToMany(targetEntity: Categ::class, inversedBy: 'films')]
    private Collection $categs;

    public function __construct()
    {
        $this->categs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Categ>
     */
    public function getCategs(): Collection
    {
        return $this->categs;
    }

    public function addCateg(Categ $categ): static
    {
        if (!$this->categs->contains($categ)) {
            $this->categs->add($categ);
        }

        return $this;
    }

    public function removeCateg(Categ $categ): static
    {
        $this->categs->removeElement($categ);

        return $this;
    }
}
