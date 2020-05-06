<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 */
class Competition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ville_competition;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_competition;

    /**
     * @ORM\OneToMany(targetEntity=Resultat::class, mappedBy="competitions")
     */
    private $resultats;

    public function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleCompetition(): ?string
    {
        return $this->ville_competition;
    }

    public function setVilleCompetition(?string $ville_competition): self
    {
        $this->ville_competition = $ville_competition;

        return $this;
    }

    public function getDateCompetition(): ?\DateTimeInterface
    {
        return $this->date_competition;
    }

    public function setDateCompetition(?\DateTimeInterface $date_competition): self
    {
        $this->date_competition = $date_competition;

        return $this;
    }

    /**
     * @return Collection|Resultat[]
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function addResultat(Resultat $resultat): self
    {
        if (!$this->resultats->contains($resultat)) {
            $this->resultats[] = $resultat;
            $resultat->setCompetitions($this);
        }

        return $this;
    }

    public function removeResultat(Resultat $resultat): self
    {
        if ($this->resultats->contains($resultat)) {
            $this->resultats->removeElement($resultat);
            // set the owning side to null (unless already changed)
            if ($resultat->getCompetitions() === $this) {
                $resultat->setCompetitions(null);
            }
        }

        return $this;
    }
}
