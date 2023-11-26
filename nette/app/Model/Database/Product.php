<?php

namespace App\Model\Database;

use App\Model\Trait\IsNewTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product {
    use IsNewTrait;
    /**
     * @ORM\Column()
     * @ORM\Id()
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(nullable=false)
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(nullable=false, type="integer")
     * @var int
     */
    protected int $price;

    /**
     * @var Brand
     * @ORM\ManyToOne(targetEntity="App\Model\Database\Brand", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    protected Brand $brand;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): Product
    {
        $this->brand = $brand;
        return $this;
    }
}