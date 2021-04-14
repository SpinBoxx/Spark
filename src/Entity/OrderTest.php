<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orderTest")
 */
class OrderTest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=550)
     */
    private $buyer;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBuyer(): User
    {
        return $this->buyer;
    }

    public function setIdBuyer($buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }
}
