<?php

namespace App\Service;

use App\Entity\SuiviProduction;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuiviProductionImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheetByName('Suivi Prod.');
        if (!$sheet) {
            throw new \RuntimeException("Feuille Excel 'Suivi Prod.' introuvable.");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header row

            if (count($row) < 2) { // Ajuste selon le vrai nombre de colonnes
                throw new \RuntimeException("Ligne $index : nombre de colonnes insuffisant.");
            }

            $entity = new SuiviProduction();
            // Exemple : adapte ces lignes à tes vraies colonnes :
            // $entity->setNom(trim((string) $row[0]));
            // $entity->setMontant($this->parseNullableFloat($row[1]));

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();
        return $imported;
    }

    private function parseNullableFloat($value): ?float
    {
        $value = str_replace(',', '.', trim((string) $value));
        return is_numeric($value) ? (float) $value : null;
    }
}
