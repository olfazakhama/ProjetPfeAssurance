<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\DemandeCreationContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass=DemandeCreationContratRepository::class)
 */
class DemandeCreationContrat
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
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;


    /**
     *@ORM\Column(type="string", length=255, nullable=true)
     *
     * )
     */
    private $cin;
    /**
     *  @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */

    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(
     *     value = 18,
     *     message = "Age est invalide "
     * )
     */
    private $age;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="float")
     */
    private $kilometre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVoiture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeVoiture;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModePaiement", inversedBy="contrats")
     */
    private $modePaiement;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clause", inversedBy="contrats")
     */
    private $clause ;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="demandes")
     * * @ORM\JoinColumn(name="user_id", onDelete="CASCADE")
     */
    private $user;

    public function getconstat()
    {
        return $this->constat;
    }

    public function setconstat( constat $constat): self
    {
        $this->constat = $constat;

        return $this;
    }
    public function getUser()
    {
        return $this->user;
    }

    public function setUser( Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeContrat", inversedBy="contrats")
     */
    private $typeContrat;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FrequencePeriodicite", inversedBy="contrats")
     */
    private $FrequencePeriodicite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Companie", inversedBy="contrats")
     */
    private $companie;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grantie", inversedBy="contrats")
     */
    private $grantie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $filecin;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $fileProfil;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $filepermis;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $vignette;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $Carte_grise;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $Vistite_technique;
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="demandeCreationContrat")
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
    public function getFilecin(): ?string
    {
        return $this->filecin;
    }

    public function setFilecin(string $filecin): self
    {
        $this->filecin = $filecin;

        return $this;
    }
    public function getvignette(): ?string
    {
        return $this->vignette;
    }

    public function setvignette(string $vignette): self
    {
        $this->vignette = $vignette;

        return $this;
    }
    public function getCarte_grise(): ?string
    {
        return $this->Carte_grise;
    }

    public function setCarte_grise(string $Carte_grise): self
    {
        $this->Carte_grise = $Carte_grise;

        return $this;
    }
    public function getfileProfil(): ?string
    {
        return $this->fileProfil;
    }

    public function setfileProfil(string $fileProfil): self
    {
        $this->fileProfil = $fileProfil;

        return $this;
    }


    public function getVistite_technique(): ?string
    {
        return $this->Vistite_technique;
    }

    public function setVistite_technique(string $Vistite_technique): self
    {
        $this->Vistite_technique = $Vistite_technique;

        return $this;
    }
    public function getfilepermis(): ?string
    {
        return $this->filepermis;
    }

    public function setfilepermis(string $filepermis): self
    {
        $this->filepermis = $filepermis;

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
    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

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

    public function getClause(): ?clause
    {
        return $this->clause;
    }

    public function setClause(?clause $clause): self
    {
        $this->clause = $clause;

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
    public function getModePaiement(): ?modePaiement
    {
        return $this->modePaiement;
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
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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
    public function getage(): ?int
    {
        return $this->age;
    }

    public function setage(int $age): self
    {
        $this->age = $age;

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
            $contrat->setDemandeCreationContrat($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrat->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getDemandeCreationContrat() === $this) {
                $contrat->setDemandeCreationContrat(null);
            }
        }

        return $this;
    }
}
