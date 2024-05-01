<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $studentID;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="veuillez remplire votre nom")
     */
    #[Assert\Length(min:3,minMessage:"veuillez avoir au moins 4 caractere")]
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Assert\Email(message:'veuillez entrer un email corect!')]
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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $birthCertificate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $admissionCertificate;

    /**
     * @ORM\ManyToMany(targetEntity=UE::class, mappedBy="students")
     */
    private $uEs;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->takeUEs = new ArrayCollection();
        $this->uEs = new ArrayCollection();
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

    public function getBirthCertificate(): ?string
    {
        return $this->birthCertificate;
    }

    public function setBirthCertificate(?string $birthCertificate): self
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    public function getAdmissionCertificate(): ?string
    {
        return $this->admissionCertificate;
    }

    public function setAdmissionCertificate(?string $admissionCertificate): self
    {
        $this->admissionCertificate = $admissionCertificate;

        return $this;
    }

    public function __toString():string
    {
        return $this->name." ".$this->studentID;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUEs(): Collection
    {
        return $this->uEs;
    }

    public function addUE(UE $uE): self
    {
        if (!$this->uEs->contains($uE)) {
            $this->uEs[] = $uE;
            $uE->addStudent($this);
        }

        return $this;
    }

    public function removeUE(UE $uE): self
    {
        if ($this->uEs->removeElement($uE)) {
            $uE->removeStudent($this);
        }

        return $this;
    }

}
