<?php

namespace App\Entity;
use App\Repository\ContratRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\GreaterThan("today")
     */
    private $dateValidite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     */

    private $kilometre;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVoiture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeVoiture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeContrat", inversedBy="contrats")
     */
    private $typeContrat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Constat", mappedBy="constat")
     */
    private $constat;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clause", inversedBy="contrats")
     */
    private $clause;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grantie", inversedBy="contrats")
     */
    private $grantie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Companie", inversedBy="contrats")
     */
    private $companie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DemandeCreationContrat", inversedBy="contrats")
     */
    private $demandeCreationContrat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModePaiement", inversedBy="contrats")
     */
    private $modePaiement;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FrequencePeriodicite", inversedBy="contrats")
     */
    private $FrequencePeriodicite;



    /**
     * toString
     * @return string
     */
    // public function __toString()
    // {
    //     $montant = (string)$this->getMontantPayer();
    //     return  $montant;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getconstat()
    {
        return $this->constat;
    }

    /**
     * @param mixed $constat
     */
    public function setconstat($constat): void
    {
        $this->constat = $constat;
    }


    public function getDateValidite(): ?\DateTimeInterface
    {
        return $this->dateValidite;
    }

    public function setDateValidite(\DateTimeInterface $dateValidite): self
    {
        $this->dateValidite = $dateValidite;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
    public function getage(): ?int
    {
        return $this->age;
    }

    public function setage(int $age): self
    {
        $this->age = $age;

        return $this;
    }



    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getKilometre(): ?float
    {
        return $this->kilometre;
    }

    public function setKilometre(float $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }
    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getNomVoiture(): ?string
    {
        return $this->nomVoiture;
    }

    public function setNomVoiture(string $nomVoiture): self
    {
        $this->nomVoiture = $nomVoiture;

        return $this;
    }

    public function getTypeVoiture(): ?string
    {
        return $this->typeVoiture;
    }

    public function setTypeVoiture(string $typeVoiture): self
    {
        $this->typeVoiture = $typeVoiture;

        return $this;
    }

    public function getTypeContrat(): ?typeContrat
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?typeContrat $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }



    public function getClause(): ?Clause
    {
        return $this->clause;
    }

    public function setClause(?Clause $clause): self
    {
        $this->clause = $clause;

        return $this;
    }

    public function getGrantie(): ?grantie
    {
        return $this->grantie;
    }

    public function setGrantie(?grantie $grantie): self
    {
        $this->grantie = $grantie;

        return $this;
    }

    public function getCompanie(): ?companie
    {
        return $this->companie;
    }

    public function setCompanie(?companie $companie): self
    {
        $this->companie = $companie;

        return $this;
    }

    public function getModePaiement(): ?modePaiement
    {
        return $this->modePaiement;
    }

    public function setModePaiement(?modePaiement $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getFrequencePeriodicite(): ?FrequencePeriodicite
    {
        return $this->FrequencePeriodicite;
    }

    public function setFrequencePeriodicite(?FrequencePeriodicite $FrequencePeriodicite): self
    {
        $this->FrequencePeriodicite = $FrequencePeriodicite;

        return $this;
    }

    public function getDemandeCreationContrat(): ?DemandeCreationContrat
    {
        return $this->demandeCreationContrat;
    }

    public function setDemandeCreationContrat(?DemandeCreationContrat $demandeCreationContrat): self
    {
        $this->demandeCreationContrat = $demandeCreationContrat;

        return $this;
    }



    public function __toString()
    {
        return $this->getNomVoiture();
    }

}
