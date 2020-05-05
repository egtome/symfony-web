<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Animals
 *
 * @ORM\Table(name="animals")
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     * @Assert\NotBlank
     * @Assert\Type(
     *      type="string",
     *      message="The value {{ value }} is not a valid {{ type }}"
     * )
     * @Assert\Regex(
     *      pattern = "/[a-zA-Z]/",
     *      message="NO! just letters here"
     * )
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=45, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z]/")
     */
    private $color;

    /**
     * @var string|null
     *
     * @ORM\Column(name="breed", type="string", length=45, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z]/")
     */
    private $breed;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[0-9]/")
     */
    private $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(?string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }


}
