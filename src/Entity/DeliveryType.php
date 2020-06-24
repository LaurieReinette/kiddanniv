<?php

namespace App\Entity;

use App\Repository\DeliveryTypeRepository;
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
}
