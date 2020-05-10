<?php

namespace App\Entity;

use App\Repository\DvdTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DvdTypeRepository::class)
 */
class DvdType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Dvd::class, mappedBy="type")
     */
    private $dvd;

    public function __construct()
    {
        $this->dvd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Dvd[]
     */
    public function getDvd(): Collection
    {
        return $this->dvd;
    }

    public function addDvd(Dvd $dvd): self
    {
        if (!$this->dvd->contains($dvd)) {
            $this->dvd[] = $dvd;
            $dvd->setType($this);
        }

        return $this;
    }

    public function removeDvd(Dvd $dvd): self
    {
        if ($this->dvd->contains($dvd)) {
            $this->dvd->removeElement($dvd);
            // set the owning side to null (unless already changed)
            if ($dvd->getType() === $this) {
                $dvd->setType(null);
            }
        }

        return $this;
    }
}
