<?php

namespace App\Entity;

use App\Repository\TeachRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeachRepository::class)
 */
class Teach
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Prefessor::class, inversedBy="teaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professor;

    /**
     * @ORM\ManyToOne(targetEntity=EC::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ec;

    /**
     * @ORM\Column(type="date")
     */
    private $teachDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessor(): ?Prefessor
    {
        return $this->professor;
    }

    public function setProfessor(?Prefessor $professor): self
    {
        $this->professor = $professor;

        return $this;
    }

    public function getEc(): ?EC
    {
        return $this->ec;
    }

    public function setEc(?EC $ec): self
    {
        $this->ec = $ec;

        return $this;
    }

    public function getTeachDate(): ?\DateTimeInterface
    {
        return $this->teachDate;
    }

    public function setTeachDate(\DateTimeInterface $teachDate): self
    {
        $this->teachDate = $teachDate;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
