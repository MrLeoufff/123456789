<?php

namespace App\Service;

use App\Entity\Tva;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TvaImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheetByName('TVA');
        if (!$sheet) {
            throw new \RuntimeException("Feuille Excel 'TVA' introuvable.");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Ignore l'en-tête

            if (empty($row[0])) continue; // Si la ligne est vide, on saute

            $entity = new Tva();
            $entity->setTva(trim((string) $row[0])); // On remplit la colonne "tva"

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();
        return $imported;
    }
}
