<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Portefeuille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $synthèseMission = null;

    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSyntheseMission(): ?string
    {
        return $this->synthèseMission;
    }

    public function setSyntheseMission(?string $synthèseMission): self
    {
        $this->synthèseMission = $synthèseMission;
        return $this;
    }

    public function getSynthèseMission(): ?string
    {
        return $this->synthèseMission;
    }

    public function setSynthèseMission(?string $synthèseMission): static
    {
        $this->synthèseMission = $synthèseMission;

        return $this;
    }
}
