<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ConstatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConstatRepository::class)
 */
class Constat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\LessThan("today")
     */

    private $dateAccident;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pointchoc;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat", inversedBy="constat")
     */
    private $contrat;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreVehicule;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomConducteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomConducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAccident(): ?\DateTimeInterface
    {
        return $this->dateAccident;
    }

    public function setDateAccident(\DateTimeInterface $dateAccident): self
    {
        $this->dateAccident = $dateAccident;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNombreVehicule(): ?int
    {
        return $this->nombreVehicule;
    }

    public function setNombreVehicule(int $nombreVehicule): self
    {
        $this->nombreVehicule = $nombreVehicule;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPointchoc()
    {
        return $this->pointchoc;
    }

    /**
     * @param mixed $pointchoc
     */
    public function setPointchoc($pointchoc): void
    {
        $this->pointchoc = $pointchoc;
    }




    public function getNomConducteur(): ?string
    {
        return $this->nomConducteur;
    }

    public function setNomConducteur(string $nomConducteur): self
    {
        $this->nomConducteur = $nomConducteur;

        return $this;
    }

    public function getPrenomConducteur(): ?string
    {
        return $this->prenomConducteur;
    }

    public function setPrenomConducteur(string $prenomConducteur): self
    {
        $this->prenomConducteur = $prenomConducteur;

        return $this;
    }

    public function getcontrat()
    {
        return $this->contrat;
    }

    public function setcontrat( contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

}
