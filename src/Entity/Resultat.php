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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultat1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultat2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resultat_final;

    /**
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competitions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResultat1(): ?string
    {
        return $this->resultat1;
    }

    public function setResultat1(?string $resultat1): self
    {
        $this->resultat1 = $resultat1;

        return $this;
    }

    public function getResultat2(): ?string
    {
        return $this->resultat2;
    }

    public function setResultat2(?string $resultat2): self
    {
        $this->resultat2 = $resultat2;

        return $this;
    }

    public function getResultatFinal(): ?string
    {
        return $this->resultat_final;
    }

    public function setResultatFinal(?string $resultat_final): self
    {
        $this->resultat_final = $resultat_final;

        return $this;
    }

    public function getParticipants(): ?Participant
    {
        return $this->participants;
    }

    public function setParticipants(?Participant $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

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
