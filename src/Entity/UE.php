<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UERepository::class)
 */
class UE
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
    private $codeUE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $credit;

    /**
     * @ORM\OneToMany(targetEntity=EC::class, mappedBy="ue", orphanRemoval=true)
     */
    private $ec;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $semester;

    /**
     * @ORM\ManyToMany(targetEntity=Field::class, inversedBy="uEs")
     */
    private $field;

    public function __construct()
    {
        $this->field = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUE(): ?string
    {
        
        return $this->codeUE;
    }

    public function setCodeUE(string $codeUE): self
    {
        $this->codeUE = $codeUE;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @return Collection<int, EC>
     */
    public function getEc(): Collection
    {
        return $this->ec;
    }

    public function addEc(EC $ec): self
    {
        if (!$this->ec->contains($ec)) {
            $this->ec[] = $ec;
            $ec->setUe($this);
        }

        return $this;
    }

    public function removeEc(EC $ec): self
    {
        if ($this->ec->removeElement($ec)) {
            // set the owning side to null (unless already changed)
            if ($ec->getUe() === $this) {
                $ec->setUe(null);
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

    public function getSemester(): ?string
    {
        return $this->semester;
    }

    public function setSemester(string $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * @return Collection<int, Field>
     */
    public function getField(): Collection
    {
        return $this->field;
    }

    public function addField(Field $field): self
    {
        if (!$this->field->contains($field)) {
            $this->field[] = $field;
        }

        return $this;
    }

    public function removeField(Field $field): self
    {
        $this->field->removeElement($field);

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }

}
