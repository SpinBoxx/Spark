<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;


/**
 *
 * @ApiResource(
 *      itemOperations={"get"},
 *      collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *  normalizationContext={"groups"={"product:read"}},
 *  denormalizationContext={"groups"={"product:write"}}
 *     
 * )
 * @ApiFilter(RangeFilter::class, properties={"price"})
 * @ApiFilter(SearchFilter::class, properties={"title": "partial"})
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * 
 */
class Product
{
    /**
     * @Groups({"product:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=State::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $state;

    /**
     * @Groups({"product:write","product:read"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups({"product:write","product:read"})
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"product:read"})
     */
    private $image_path_1;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Groups({"product:read"})
   */
  private $image_path_2;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Groups({"product:read"})
   */
  private $image_path_3;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Groups({"product:read"})
   */
  private $image_path_4;

  /**
   * @ORM\Column(type="text", nullable=true)
   * @Groups({"product:read"})
   */
  private $image_path_5;

    /**
     * @Groups({"product:read"})
     * @ORM\ManyToOne(targetEntity=Gender::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class)
     * @Groups({"product:write","product:read"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $size;

    /**
     * @Groups({"product:read"})
     * @ORM\ManyToOne(targetEntity=Color::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $color_primary;

    /**
     * @Groups({"product:read"})
     * @ORM\ManyToOne(targetEntity=Color::class)
     */
    private $color_secondary;

    /**
     * @Groups({"product:read","product:write"})
     * @ORM\ManyToOne(targetEntity=Brand::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $brand;

    /**
     * @Groups({"product:read"})
     * @ORM\ManyToOne(targetEntity=Quality::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @Groups({"product:read"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @Groups({"product:write","product:read"})
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @Groups({"product:read"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

    /**
     * @Groups({"product:read"})
     * @ORM\Column(type="datetime")
     */
    private $creation_datetime;

    /**
     * @Groups({"product:read"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_datetime;


    public function __construct()
    {
        $this->setCreationDatetime(new \DateTime("now"));
    }

    public function setId(int $id)
    {
        $this->$id = $id;
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
    public function setQuality(Quality $quality): void
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

  /**
   * @return mixed
   */
  public function getImagePath1()
  {
    return $this->image_path_1;
  }

  /**
   * @param mixed $image_path_1
   */
  public function setImagePath1($image_path_1): void
  {
    $this->image_path_1 = $image_path_1;
  }

  /**
   * @return mixed
   */
  public function getImagePath2()
  {
    return $this->image_path_2;
  }

  /**
   * @param mixed $image_path_2
   */
  public function setImagePath2($image_path_2): void
  {
    $this->image_path_2 = $image_path_2;
  }

  /**
   * @return mixed
   */
  public function getImagePath3()
  {
    return $this->image_path_3;
  }

  /**
   * @param mixed $image_path_3
   */
  public function setImagePath3($image_path_3): void
  {
    $this->image_path_3 = $image_path_3;
  }

  /**
   * @return mixed
   */
  public function getImagePath4()
  {
    return $this->image_path_4;
  }

  /**
   * @param mixed $image_path_4
   */
  public function setImagePath4($image_path_4): void
  {
    $this->image_path_4 = $image_path_4;
  }

  /**
   * @return mixed
   */
  public function getImagePath5()
  {
    return $this->image_path_5;
  }

  /**
   * @param mixed $image_path_5
   */
  public function setImagePath5($image_path_5): void
  {
    $this->image_path_5 = $image_path_5;
  }
}
