<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Is2024
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $code = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 20)]
    private ?string $telFixe = null;

    #[ORM\Column(length: 20)]
    private ?string $telPortable = null;

    #[ORM\Column(length: 20)]
    private ?string $siren = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $rfN2 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $rfN1 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $isN1 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $liquid = null;

    // Génère les getters/setters avec "php bin/console make:entity --regenerate"

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(string $telFixe): static
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(string $telPortable): static
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): static
    {
        $this->siren = $siren;

        return $this;
    }

    public function getRfN2(): ?float
    {
        return $this->rfN2;
    }

    public function setRfN2(?float $rfN2): static
    {
        $this->rfN2 = $rfN2;

        return $this;
    }

    public function getRfN1(): ?float
    {
        return $this->rfN1;
    }

    public function setRfN1(?float $rfN1): static
    {
        $this->rfN1 = $rfN1;

        return $this;
    }

    public function getIsN1(): ?float
    {
        return $this->isN1;
    }

    public function setIsN1(?float $isN1): static
    {
        $this->isN1 = $isN1;

        return $this;
    }

    public function getLiquid(): ?float
    {
        return $this->liquid;
    }

    public function setLiquid(?float $liquid): static
    {
        $this->liquid = $liquid;

        return $this;
    }
}
