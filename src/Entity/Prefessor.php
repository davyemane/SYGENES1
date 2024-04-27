<?php

namespace App\Entity;

use App\Repository\PrefessorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrefessorRepository::class)
 */
class Prefessor
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity=Teach::class, mappedBy="professor")
     */
    private $teaches;

    public function __construct()
    {
        $this->teaches = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection<int, Teach>
     */
    public function getTeaches(): Collection
    {
        return $this->teaches;
    }

    public function addTeach(Teach $teach): self
    {
        if (!$this->teaches->contains($teach)) {
            $this->teaches[] = $teach;
            $teach->setProfessor($this);
        }

        return $this;
    }

    public function removeTeach(Teach $teach): self
    {
        if ($this->teaches->removeElement($teach)) {
            // set the owning side to null (unless already changed)
            if ($teach->getProfessor() === $this) {
                $teach->setProfessor(null);
            }
        }

        return $this;
    }
}
