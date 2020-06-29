<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $age_min;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $age_max;

    /**
     * @ORM\Column(type="smallint")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=Party::class, mappedBy="prestations")
     */
    private $parties;

    /**
     * @ORM\ManyToMany(targetEntity=Pro::class, inversedBy="deliveries")
     */
    private $pros;

    /**
     * @ORM\ManyToMany(targetEntity=DeliveryType::class, inversedBy="deliveries")
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->pros = new ArrayCollection();
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgeMin(): ?int
    {
        return $this->age_min;
    }

    public function setAgeMin(int $age_min): self
    {
        $this->age_min = $age_min;

        return $this;
    }

    public function getAgeMax(): ?int
    {
        return $this->age_max;
    }

    public function setAgeMax(?int $age_max): self
    {
        $this->age_max = $age_max;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Party[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Party $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->addPrestation($this);
        }

        return $this;
    }

    public function removeParty(Party $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            $party->removePrestation($this);
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

    /**
     * @return Collection|DeliveryType[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(DeliveryType $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(DeliveryType $type): self
    {
        if ($this->type->contains($type)) {
            $this->type->removeElement($type);
        }

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
