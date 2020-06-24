<?php

namespace App\Entity;

use App\Repository\ProRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProRepository::class)
 */
class Pro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $firm;

    /**
     * @ORM\Column(type="smallint")
     */
    private $departement_shifting;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mobilephone;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $otherphone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirm(): ?string
    {
        return $this->firm;
    }

    public function setFirm(?string $firm): self
    {
        $this->firm = $firm;

        return $this;
    }

    public function getDepartementShifting(): ?int
    {
        return $this->departement_shifting;
    }

    public function setDepartementShifting(int $departement_shifting): self
    {
        $this->departement_shifting = $departement_shifting;

        return $this;
    }

    public function getMobilephone(): ?int
    {
        return $this->mobilephone;
    }

    public function setMobilephone(int $mobilephone): self
    {
        $this->mobilephone = $mobilephone;

        return $this;
    }

    public function getOtherphone(): ?int
    {
        return $this->otherphone;
    }

    public function setOtherphone(?int $otherphone): self
    {
        $this->otherphone = $otherphone;

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
}
