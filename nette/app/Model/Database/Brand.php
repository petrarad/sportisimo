<?php

namespace App\Model\Database;

use App\Model\Trait\IsNewTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Brand {
    use IsNewTrait;
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="4")
     */
    protected int $id;

    /**
     * @ORM\Column(nullable=false)
     * @var string
     */
    protected string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Brand
    {
        $this->name = $name;
        return $this;
    }
}