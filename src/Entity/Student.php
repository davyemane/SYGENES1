<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
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
    private $studentID;

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
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="text")
     */
    private $placeOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity=Field::class, inversedBy="student")
     * @ORM\JoinColumn(nullable=false)
     */
    private $field;

    /**
     * @ORM\OneToMany(targetEntity=Notes::class, mappedBy="student")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity=TakeUE::class, mappedBy="student")
     */
    private $takeUEs;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->takeUEs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentID(): ?string
    {
        return $this->studentID;
    }

    public function setStudentID(string $studentID): self
    {
        $this->studentID = $studentID;

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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return Collection<int, Notes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setStudent($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getStudent() === $this) {
                $note->setStudent(null);
            }
        }

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, TakeUE>
     */
    public function getTakeUEs(): Collection
    {
        return $this->takeUEs;
    }

    public function addTakeUE(TakeUE $takeUE): self
    {
        if (!$this->takeUEs->contains($takeUE)) {
            $this->takeUEs[] = $takeUE;
            $takeUE->setStudent($this);
        }

        return $this;
    }

    public function removeTakeUE(TakeUE $takeUE): self
    {
        if ($this->takeUEs->removeElement($takeUE)) {
            // set the owning side to null (unless already changed)
            if ($takeUE->getStudent() === $this) {
                $takeUE->setStudent(null);
            }
        }

        return $this;
    }
}
