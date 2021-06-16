<?php

namespace App\Entity;

use App\Repository\PrimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrimeRepository::class)
 */
class Prime
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
    private $montantInitiale;

    /**
     * @ORM\Column(type="float")
     */
    private $montantFrequence;

    /**
     * @ORM\Column(type="float")
     */
    private $montantPayer;


    
    /**
     * @ORM\Column(type="integer")
     */
    private $annee;




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

    public function getMontantInitiale(): ?float
    {
        return $this->montantInitiale;
    }

    public function setMontantInitiale(float $montantInitiale): self
    {
        $this->montantInitiale = $montantInitiale;

        return $this;
    }

    public function getMontantFrequence(): ?float
    {
        return $this->montantFrequence;
    }

    public function setMontantFrequence(float $montantFrequence): self
    {
        $this->montantFrequence = $montantFrequence;

        return $this;
    }

    public function getMontantPayer(): ?float
    {
        return $this->montantPayer;
    }

    public function setMontantPayer(float $montantPayer): self
    {
        $this->montantPayer = $montantPayer;

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

    /**
* toString
* @return string
*/
public function __toString()
{
    $montant = (string)$this->getMontantPayer();
    return  $montant;
}





public function getAnnee(): ?int
{
    return $this->annee;
}

public function setAnnee(int $annee): self
{
    $this->annee = $annee;

    return $this;
}



}
