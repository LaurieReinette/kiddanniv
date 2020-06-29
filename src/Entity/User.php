<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Un compte est déjà enregistré avec cette adresse")
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
     *@Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas un email valide, merci de corriger."
     * )
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 51,
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom ne peut contenir de chiffre"
     * )
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut contenir de chiffre"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * 
     * @ORM\Column(type="string", length=10)
     */
    private $gender;

    /**
     * 
     * @Assert\Range(
     *      min = 01000,
     *      max = 97699,
     *      notInRangeMessage = "Entrez un code postal valide",
     * )
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $postalcode;

    /**
     * 
     * @ORM\Column(type="string", length=50 )
     */
    private $city;

    /**
     * @ORM\Column(type="smallint")
     */
    private $departement;
    //"02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","2A","2B","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","87","88","89","90","91","92","93","94","95","971","972","973","974","976"

    /**
     * @Assert\Regex(
     *     pattern="/^0[67]([0-9]{2}){4}/",
     *     match=false,
     *     message="Entre un numéro de portable débutant par 06 ou 07"
     * )
     * @ORM\Column(type="integer")
     */
    private $mobilephone;

    /**
     * @Assert\Regex(
     *     pattern="/^0[12345679]([0-9]{2}){4}/",
     *     match=false,
     *     message="Entre un numéro de téléphone valide"
     * )
     * @ORM\Column(type="integer", nullable=true)
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $role;


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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
