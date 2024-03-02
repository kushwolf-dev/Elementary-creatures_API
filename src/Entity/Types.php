<?php

namespace App\Entity;

use App\Repository\TypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesRepository::class)]
class Types
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: PokemonCard::class, inversedBy: 'types')]
    private Collection $PokemonCards;

    #[ORM\Column(length: 255)]
    private ?string $Type_name = null;

    public function __construct()
    {
        $this->PokemonCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PokemonCard>
     */
    public function getPokemonCards(): Collection
    {
        return $this->PokemonCards;
    }

    public function addPokemonCard(PokemonCard $pokemonCard): static
    {
        if (!$this->PokemonCards->contains($pokemonCard)) {
            $this->PokemonCards->add($pokemonCard);
        }

        return $this;
    }

    public function removePokemonCard(PokemonCard $pokemonCard): static
    {
        $this->PokemonCards->removeElement($pokemonCard);

        return $this;
    }

    public function getTypeName(): ?string
    {
        return $this->Type_name;
    }

    public function setTypeName(string $Type_name): static
    {
        $this->Type_name = $Type_name;

        return $this;
    }
}
