<?php

namespace App\Service;

use App\Entity\Portefeuille;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PortefeuilleImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheetByName('Données Portefeuille');
        if (!$sheet) {
            throw new \RuntimeException("Feuille Excel 'Données Portefeuille' introuvable.");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header row

            if (count($row) < 2) { // À ajuster selon les colonnes attendues
                throw new \RuntimeException("Ligne $index : nombre de colonnes insuffisant.");
            }

            $entity = new Portefeuille();
            // Adapte ici les colonnes selon la structure réelle :
            // Exemple :
            // $entity->setClientCode(trim((string) $row[0]));
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
