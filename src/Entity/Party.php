<?php

namespace App\Entity;

use App\Repository\PartyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartyRepository::class)
 */
class Party
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $hour_start;

    /**
     * @ORM\Column(type="time")
     */
    private $hour_end;

    /**
     * @ORM\Column(type="smallint")
     */
    private $child_age;

    /**
     * @ORM\Column(type="smallint")
     */
    private $children_number;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $place_type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $moderate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="parties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organised_by;

    /**
     * @ORM\ManyToMany(targetEntity=Delivery::class, inversedBy="parties")
     */
    private $prestations;

    /**
     * @ORM\ManyToMany(targetEntity=Pro::class, inversedBy="parties")
     */
    private $pros;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->pros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHourStart(): ?\DateTimeInterface
    {
        return $this->hour_start;
    }

    public function setHourStart(\DateTimeInterface $hour_start): self
    {
        $this->hour_start = $hour_start;

        return $this;
    }

    public function getHourEnd(): ?\DateTimeInterface
    {
        return $this->hour_end;
    }

    public function setHourEnd(\DateTimeInterface $hour_end): self
    {
        $this->hour_end = $hour_end;

        return $this;
    }

    public function getChildAge(): ?int
    {
        return $this->child_age;
    }

    public function setChildAge(int $child_age): self
    {
        $this->child_age = $child_age;

        return $this;
    }

    public function getChildrenNumber(): ?int
    {
        return $this->children_number;
    }

    public function setChildrenNumber(int $children_number): self
    {
        $this->children_number = $children_number;

        return $this;
    }

    public function getPlaceType(): ?string
    {
        return $this->place_type;
    }

    public function setPlaceType(string $place_type): self
    {
        $this->place_type = $place_type;

        return $this;
    }

    public function getModerate(): ?bool
    {
        return $this->moderate;
    }

    public function setModerate(?bool $moderate): self
    {
        $this->moderate = $moderate;

        return $this;
    }

    public function getOrganisedBy(): ?User
    {
        return $this->organised_by;
    }

    public function setOrganisedBy(?User $organised_by): self
    {
        $this->organised_by = $organised_by;

        return $this;
    }

    /**
     * @return Collection|Delivery[]
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Delivery $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
        }

        return $this;
    }

    public function removePrestation(Delivery $prestation): self
    {
        if ($this->prestations->contains($prestation)) {
            $this->prestations->removeElement($prestation);
        }

        return $this;
    }

    /**
     * @return Collection|Pro[]
     */
    public function getPros(): Collection
    {
        return $this->pros;
    }

    public function addPro(Pro $pro): self
    {
        if (!$this->pros->contains($pro)) {
            $this->pros[] = $pro;
        }

        return $this;
    }

    public function removePro(Pro $pro): self
    {
        if ($this->pros->contains($pro)) {
            $this->pros->removeElement($pro);
        }

        return $this;
    }
}
