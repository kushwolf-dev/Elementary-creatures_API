<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypesCardRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypesCardRepository::class)]
class TypesCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getCard"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $name_type = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $color_type = null;

    #[ORM\ManyToMany(targetEntity: PokemonCard::class, inversedBy: 'typesCards')]
    private Collection $PokemonCards;

    public function __construct()
    {
        $this->PokemonCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameType(): ?string
    {
        return $this->name_type;
    }

    public function setNameType(string $name_type): static
    {
        $this->name_type = $name_type;

        return $this;
    }

    public function getColorType(): ?string
    {
        return $this->color_type;
    }

    public function setColorType(string $color_type): static
    {
        $this->color_type = $color_type;

        return $this;
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
}
