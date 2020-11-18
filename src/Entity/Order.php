<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\ManyToOne(targetEntity=Civility::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delivery_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $additional_address;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email_address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $purchase_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBuyer(): ?User
    {
        return $this->buyer;
    }

    public function setIdBuyer(?User $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getIdSeller(): ?Product
    {
        return $this->seller;
    }

    public function setIdSeller(Product $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->product;
    }

    public function setIdProduct(Product $product): self
    {
        $this->product = $product;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCivilityId(): ?Civility
    {
        return $this->civility;
    }

    public function setCivilityId(?Civility $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): self
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additional_address;
    }

    public function setAdditionalAddress(string $additional_address): self
    {
        $this->additional_address = $additional_address;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->email_address;
    }

    public function setEmailAddress(string $email_address): self
    {
        $this->email_address = $email_address;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchase_date;
    }

    public function setPurchaseDate(\DateTimeInterface $purchase_date): self
    {
        $this->purchase_date = $purchase_date;

        return $this;
    }
}
