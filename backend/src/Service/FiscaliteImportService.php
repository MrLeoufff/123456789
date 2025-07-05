<?php

namespace App\Service;

use App\Entity\Fiscalite;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FiscaliteImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheetByName('Fiscalité');
        
        if (!$sheet) {
            throw new \RuntimeException("Feuille 'Fiscalité' introuvable dans le fichier Excel.");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Ignore l'en-tête

            $entity = new Fiscalite();
            // TODO : Mapper correctement les colonnes ici selon ta feuille Excel
            // Exemple :
            // $entity->setChamp((string) $row[0]);

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();

        return $imported;
    }
}
