<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * },
 *     collectionOperations={"post"},
 *     itemOperations={}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @Groups("read")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=30)
     */
    private $username;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $firstname;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lastname;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * @Groups("write")
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * 
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $phone;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postal_address;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional_address;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $postal_code;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $city;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $department;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $country;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture_profil;

    /**
     * @Groups("read")
     * @ORM\Column(type="datetime")
     */
    private $creation_datetime;

    /**
     * @Groups("read")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_datetime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
        $this->creation_datetime = DateTime::createFromFormat('Y-m-d H:i:s', date('d-m-Y H:i:s'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPostal_Address(): ?string
    {
        return $this->postal_address;
    }

    public function setPostal_Address(?string $postal_address): self
    {
        $this->postal_address = $postal_address;

        return $this;
    }

    public function getPostal_Code(): ?string
    {
        return $this->postal_code;
    }

    public function setPostal_Code(?string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additional_address;
    }

    public function setAdditionalAddress(?string $additional_address): self
    {
        $this->additional_address = $additional_address;

        return $this;
    }

    public function getPictureProfil(): ?string
    {
        return $this->picture_profil;
    }

    public function setPictureProfil(?string $picture_profil): self
    {
        $this->picture_profil = $picture_profil;

        return $this;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creation_datetime;
    }

    public function setCreationDatetime(\DateTimeInterface $creation_datetime): self
    {
        $this->creation_datetime = $creation_datetime;

        return $this;
    }

    public function getUpdateDatetime(): ?\DateTimeInterface
    {
        return $this->update_datetime;
    }

    public function setUpdateDatetime(?\DateTimeInterface $update_datetime): self
    {
        $this->update_datetime = $update_datetime;

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }


    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
