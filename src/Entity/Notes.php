<?php

namespace App\Entity;

use App\Repository\NotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotesRepository::class)
 */
class Notes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $noteCC;

    /**
     * @ORM\Column(type="float")
     */
    private $noteSN;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $noteTP;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $noteRattrapge;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="notes")
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity=EC::class, inversedBy="notes")
     */
    private $ec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoteCC(): ?float
    {
        return $this->noteCC;
    }

    public function setNoteCC(float $noteCC): self
    {
        $this->noteCC = $noteCC;

        return $this;
    }

    public function getNoteSN(): ?float
    {
        return $this->noteSN;
    }

    public function setNoteSN(float $noteSN): self
    {
        $this->noteSN = $noteSN;

        return $this;
    }

    public function getNoteTP(): ?float
    {
        return $this->noteTP;
    }

    public function setNoteTP(?float $noteTP): self
    {
        $this->noteTP = $noteTP;

        return $this;
    }

    public function getNoteRattrapge(): ?float
    {
        return $this->noteRattrapge;
    }

    public function setNoteRattrapge(?float $noteRattrapge): self
    {
        $this->noteRattrapge = $noteRattrapge;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

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
}
