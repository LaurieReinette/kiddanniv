<?php

namespace App\Entity;

use App\Repository\DeliveryTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryTypeRepository::class)
 */
class DeliveryType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $forkids;

    /**
     * @ORM\Column(type="boolean")
     */
    private $foradults;

    /**
     * @ORM\ManyToMany(targetEntity=Delivery::class, mappedBy="type")
     */
    private $deliveries;

    public function __construct()
    {
        $this->deliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getForkids(): ?bool
    {
        return $this->forkids;
    }

    public function setForkids(bool $forkids): self
    {
        $this->forkids = $forkids;

        return $this;
    }

    public function getForadults(): ?bool
    {
        return $this->foradults;
    }

    public function setForadults(bool $foradults): self
    {
        $this->foradults = $foradults;

        return $this;
    }

    /**
     * @return Collection|Delivery[]
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries[] = $delivery;
            $delivery->addType($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->contains($delivery)) {
            $this->deliveries->removeElement($delivery);
            $delivery->removeType($this);
        }

        return $this;
    }
}
