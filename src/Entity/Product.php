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
     * @ORM\ManyToOne(targetEntity=State::class)
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
     * @ORM\ManyToOne(targetEntity=Gender::class)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $color_primary;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class)
     */
    private $color_secondary;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Quality::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
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

    public function getGenderId(): ?Gender
    {
        return $this->gender;
    }

    public function setGenderId(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getSizeId(): ?Size
    {
        return $this->size;
    }

    public function setSizeId(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->type;
    }

    public function setTypeId(?Type $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getBrandId(): ?Brand
    {
        return $this->brand;
    }

    public function setBrandId(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getQualityId(): ?Quality
    {
        return $this->quality;
    }

    public function setQualityId(?Quality $quality): self
    {
        $this->quality = $quality;

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
