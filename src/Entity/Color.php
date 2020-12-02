<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $hex_color;

    /**
     * Color constructor.
     * @param $id
     * @param $code
     * @param $label
     * @param $hex_color
     */
    public function __construct($code, $label, $hex_color)
    {
        $this->code = $code;
        $this->label = $label;
        $this->hex_color = $hex_color;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getHexColor(): ?string
    {
        return $this->hex_color;
    }

    public function setHexColor(string $hex_color): self
    {
        $this->hex_color = $hex_color;

        return $this;
    }

}
