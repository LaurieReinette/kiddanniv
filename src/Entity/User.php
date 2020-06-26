<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email(
     *     message = "Entrez une adresse mail valide"
     * )
     * @ORM\Column(type="string", length=60, unique=true,)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit faire au moins{{ limit }} caractères",
     *      maxMessage = "Votre prénom de peut pas dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $gender;

    /**
     * 
     * @Assert\Range(
     *      min = 01000,
     *      max = 97699,
     *      notInRangeMessage = "Entre un code postal valide",
     * )
     * @Assert\
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $postalcode;

    /**
     * 
     * @ORM\Column(type="string", length=50 )
     */
    private $city;

    /**
     * @Assert\Choice({1,2,3})
     * @ORM\Column(type="smallint")
     */
    private $departement;

    /**
     * @ORM\Column(type="smallint")
     */
    private $phone;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mobilephone;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $otherphone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $moderate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdat;

    /**
     * @ORM\OneToMany(targetEntity=Party::class, mappedBy="organised_by")
     */
    private $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

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

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPostalcode(): ?int
    {
        return $this->postalcode;
    }

    public function setPostalcode(int $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDepartement(): ?int
    {
        return $this->departement;
    }

    public function setDepartement(int $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

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

    public function getModerate(): ?bool
    {
        return $this->moderate;
    }

    public function setModerate(?bool $moderate): self
    {
        $this->moderate = $moderate;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

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
            $party->setOrganisedBy($this);
        }

        return $this;
    }

    public function removeParty(Party $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getOrganisedBy() === $this) {
                $party->setOrganisedBy(null);
            }
        }

        return $this;
    }
}
