<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=State::class,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $picture_product = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $color_primary;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class,cascade={"persist"})
     */
    private $color_secondary;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_datetime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_datetime;

    /**
     * Product constructor.
     * @param $user
     * @param $state
     * @param $title
     * @param $description
     * @param array $picture_product
     * @param $gender
     * @param $size
     * @param $color_primary
     * @param $color_secondary
     * @param $brand
     * @param $quality
     * @param $category
     * @param $price
     */
    public function __construct($user, $state, $title, $description, array $picture_product, $gender, $size, $color_primary, $color_secondary, $brand, $quality, $category, $price)
    {
        $this->user = $user;
        $this->state = $state;
        $this->title = $title;
        $this->description = $description;
        $this->picture_product = $picture_product;
        $this->gender = $gender;
        $this->size = $size;
        $this->color_primary = $color_primary;
        $this->color_secondary = $color_secondary;
        $this->brand = $brand;
        $this->quality = $quality;
        $this->category = $category;
        $this->price = $price;
        $this->creation_datetime = new \DateTime('now');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStateId(): ?State
    {
        return $this->state;
    }

    public function setStateId(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getColorPrimary()
    {
        return $this->color_primary;
    }

    /**
     * @param mixed $color_primary
     */
    public function setColorPrimary($color_primary): void
    {
        $this->color_primary = $color_primary;
    }

    /**
     * @return mixed
     */
    public function getColorSecondary()
    {
        return $this->color_secondary;
    }

    /**
     * @param mixed $color_secondary
     */
    public function setColorSecondary($color_secondary): void
    {
        $this->color_secondary = $color_secondary;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     */
    public function setQuality($quality): void
    {
        $this->quality = $quality;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getColorPrimaryId(): ?Color
    {
        return $this->color_primary;
    }

    public function setColorPrimaryId(?Color $color_primary): self
    {
        $this->color_primary = $color_primary;

        return $this;
    }

    public function getColorSecondaryId(): ?Color
    {
        return $this->color_secondary;
    }

    public function setColorSecondaryId(?Color $color_secondary): self
    {
        $this->color_secondary = $color_secondary;

        return $this;
    }


    public function getCategoryId(): ?Category
    {
        return $this->category;
    }

    public function setCategoryId(?Category $category): self
    {
        $this->category = $category;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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

    public function getPictureProduct(): ?array
    {
        return $this->picture_product;
    }

    public function setPictureProduct(array $picture_product): self
    {
        $this->picture_product = $picture_product;

        return $this;
    }
}
