<?php

namespace App\Entity;

use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZoneRepository::class)
 */
class Zone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="zones")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=PointSurveillance::class, mappedBy="zone")
     */
    private $points;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|PointSurveillance[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(PointSurveillance $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->setZone($this);
        }

        return $this;
    }

    public function removePoint(PointSurveillance $point): self
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getZone() === $this) {
                $point->setZone(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
