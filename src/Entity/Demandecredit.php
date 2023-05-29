<?php

namespace App\Entity;

use App\Repository\DemandecreditRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandecreditRepository::class)
 */
class Demandecredit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",name="idcredit")
     */
    private $idcredit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cause;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin;
/**
* @ORM\ManyToOne(targetEntity="App\Entity\Compte")
 * @ORM\JoinColumn(name="numero", referencedColumnName="numero", nullable=false, onDelete="RESTRICT")
  */
private $numero;


    public function getIdcredit(): ?int
    {
        return $this->idcredit;
    }
    public function setIdcredit(string $idcredit): self
    {
        $this->idcredit = $idcredit;

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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    

    public function setNumero(Compte $numero): self
    {
        $this->numero = $numero;
        return $this;
    }
    


}
