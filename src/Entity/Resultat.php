<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultatRepository::class)
 */
class Resultat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $result1;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $resultat2;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $resultat_final;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class, inversedBy="resultats")
     */
    private $competitions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult1(): ?\DateTimeInterface
    {
        return $this->result1;
    }

    public function setResult1(?\DateTimeInterface $result1): self
    {
        $this->result1 = $result1;

        return $this;
    }

    public function getResultat2(): ?\DateTimeInterface
    {
        return $this->resultat2;
    }

    public function setResultat2(?\DateTimeInterface $resultat2): self
    {
        $this->resultat2 = $resultat2;

        return $this;
    }

    public function getResultatFinal(): ?\DateTimeInterface
    {
        return $this->resultat_final;
    }

    public function setResultatFinal(?\DateTimeInterface $resultat_final): self
    {
        $this->resultat_final = $resultat_final;

        return $this;
    }

    public function getCompetitions(): ?Competition
    {
        return $this->competitions;
    }

    public function setCompetitions(?Competition $competitions): self
    {
        $this->competitions = $competitions;

        return $this;
    }
}
