<?php

namespace App\Entity;

use App\Repository\BonusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonusRepository::class)
 */
class Bonus
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
    private $annee;

    /**
     * @ORM\Column(type="float")
     */
    private $coefficient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bonus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getBonus(): ?string
    {
        return $this->bonus;
    }

    public function setBonus(string $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }
}
