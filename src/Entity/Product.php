<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ApiResource(
 *  
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @Groups("read")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("read")
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Groups("write","read")
     * @ORM\ManyToOne(targetEntity=State::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $state;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("write","read")
     */
    private $image_path;

    /**
     * @Groups("write","read")
     * @ORM\ManyToOne(targetEntity=Gender::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class)
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @Groups("write","read")
     * @ORM\ManyToOne(targetEntity=Color::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $color_primary;

    /**
     * @Groups("write","read")
     * @ORM\ManyToOne(targetEntity=Color::class)
     */
    private $color_secondary;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @Groups("write","read")
     * @ORM\ManyToOne(targetEntity=Quality::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @Groups("write","read")
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @Groups("write","read")
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

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
     * Product constructor.
     * @param User $user
     * @param State $state
     * @param Gender $gender
     * @param Color $color_primary
     * @param $title
     * @param $description
     * @param $size
     * @param $brand
     * @param $category
     * @param $price
     * @param Quality $quality
     */
    public function __construct()
    {
        $this->setCreationDatetime(new \DateTime('now'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
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

    public function getImagePath(): string
    {
        return $this->image_path;
    }

    public function setImagePath(string $picture_product)
    {
        $this->image_path = $picture_product;
    }
}
