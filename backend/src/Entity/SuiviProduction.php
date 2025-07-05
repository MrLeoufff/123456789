<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class SuiviProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $suiviProduction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuiviProduction(): ?string
    {
        return $this->suiviProduction;
    }

    public function setSuiviProduction(?string $suiviProduction): self
    {
        $this->suiviProduction = $suiviProduction;
        return $this;
    }
}
