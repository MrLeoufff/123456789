<?php

namespace App\Service;

use App\Entity\Bilan;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BilanImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);

        $sheet = $spreadsheet->getSheetByName('Bilans');
        if (!$sheet) {
            throw new \RuntimeException("Feuille 'Bilans' introuvable dans le fichier Excel.");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Ignorer l'en-tête

            $entity = new Bilan();

            // TODO : Mapper les colonnes (exemple fictif)
            // $entity->setCode((string) $row[1]);
            // $entity->setNom((string) $row[2]);
            // etc.

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();

        return $imported;
    }
}
