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
}
