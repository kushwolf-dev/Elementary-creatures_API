<?php

namespace App\Entity;

use App\Repository\PokemonCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonCardRepository::class)]
class PokemonCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getCard"])]
    
    private ?int $id = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $description = null;

    #[ORM\Column]#[Groups(["getCard"])]
    private ?int $number = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $hp = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Ability = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Weakness = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Resistance = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Evolve_1 = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Evolve_2 = null;

    #[ORM\Column(length: 500)]#[Groups(["getCard"])]
    private ?string $Background_image = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Rarity = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Attack_1 = null;

    #[ORM\Column(length: 255)]#[Groups(["getCard"])]
    private ?string $Attack_2 = null;

    #[ORM\ManyToMany(targetEntity: TypesCard::class, mappedBy: 'PokemonCards')]#[Groups(["getCard"])]
    private Collection $typesCards;

    public function __construct()
    {
        $this->typesCards = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getHp(): ?string
    {
        return $this->hp;
    }

    public function setHp(string $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAbility(): ?string
    {
        return $this->Ability;
    }

    public function setAbility(string $Ability): static
    {
        $this->Ability = $Ability;

        return $this;
    }

    public function getWeakness(): ?string
    {
        return $this->Weakness;
    }

    public function setWeakness(string $Weakness): static
    {
        $this->Weakness = $Weakness;

        return $this;
    }

    public function getResistance(): ?string
    {
        return $this->Resistance;
    }

    public function setResistance(string $Resistance): static
    {
        $this->Resistance = $Resistance;

        return $this;
    }


    public function getEvolve1(): ?string
    {
        return $this->Evolve_1;
    }

    public function setEvolve1(string $Evolve_1): static
    {
        $this->Evolve_1 = $Evolve_1;

        return $this;
    }

    public function getEvolve2(): ?string
    {
        return $this->Evolve_2;
    }

    public function setEvolve2(string $Evolve_2): static
    {
        $this->Evolve_2 = $Evolve_2;

        return $this;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->Background_image;
    }

    public function setBackgroundImage(string $Background_image): static
    {
        $this->Background_image = $Background_image;

        return $this;
    }

    public function getRarity(): ?string
    {
        return $this->Rarity;
    }

    public function setRarity(string $Rarity): static
    {
        $this->Rarity = $Rarity;

        return $this;
    }

    public function getAttack1(): ?string
    {
        return $this->Attack_1;
    }

    public function setAttack1(string $Attack_1): static
    {
        $this->Attack_1 = $Attack_1;

        return $this;
    }

    public function getAttack2(): ?string
    {
        return $this->Attack_2;
    }

    public function setAttack2(string $Attack_2): static
    {
        $this->Attack_2 = $Attack_2;

        return $this;
    }

    /**
     * @return Collection<int, TypesCard>
     */
    public function getTypesCards(): Collection
    {
        return $this->typesCards;
    }

    public function addTypesCard(TypesCard $typesCard): static
    {
        if (!$this->typesCards->contains($typesCard)) {
            $this->typesCards->add($typesCard);
            $typesCard->addPokemonCard($this);
        }

        return $this;
    }

    public function removeTypesCard(TypesCard $typesCard): static
    {
        if ($this->typesCards->removeElement($typesCard)) {
            $typesCard->removePokemonCard($this);
        }

        return $this;
    }
}