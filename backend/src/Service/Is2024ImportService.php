<?php

namespace App\Service;

use App\Entity\Is2024;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Is2024ImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheet(0);
        if (!$sheet) {
            throw new \RuntimeException("Feuille Excel introuvable (index 0).");
        }

        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header row

            if (count($row) < 10) {
                throw new \RuntimeException("Ligne $index : nombre de colonnes insuffisant.");
            }

            $entity = new Is2024();
            $entity->setCode(trim((string) $row[0]));
            $entity->setNom(trim((string) $row[1]));
            $entity->setVille(trim((string) $row[2]));
            $entity->setTelFixe(trim((string) $row[3]));
            $entity->setTelPortable(trim((string) $row[4]));
            $entity->setSiren(trim((string) $row[5]));
            $entity->setRfN2($this->parseNullableFloat($row[6]));
            $entity->setRfN1($this->parseNullableFloat($row[7]));
            $entity->setIsN1($this->parseNullableFloat($row[8]));
            $entity->setLiquid($this->parseNullableFloat($row[9]));

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();
        return $imported;
    }

    private function parseNullableFloat($value): ?float
    {
        $value = str_replace(',', '.', trim((string) $value)); // gestion des virgules
        return is_numeric($value) ? (float) $value : null;
    }
}
