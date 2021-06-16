<?php

namespace App\Entity;

use App\Repository\ClauseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClauseRepository::class)
 */
class Clause
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
    private $type;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="typecontrat")
     */
    private $contrat;

    public function __construct()
    {
        $this->contrat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function gettype(): ?string
    {
        return $this->type;
    }

    public function settype(string $type): self
    {
        $this->type = $type;

        return $this;
    }






    /**
     * @return Collection|Contrat[]
     */
    public function getContrat(): Collection
    {
        return $this->contrat;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrat->contains($contrat)) {
            $this->contrat[] = $contrat;
            $contrat->setTypecontrat($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrat->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getTypecontrat() === $this) {
                $contrat->setTypecontrat(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->gettype();
    }
}
