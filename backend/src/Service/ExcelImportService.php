<?php

namespace App\Service;

use App\Entity\Is2024;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function import(string $filePath): int
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheet(0);
        $rows = $sheet->toArray();
        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header row

            $entity = new Is2024();
            $entity->setCode((string) $row[0]);
            $entity->setNom((string) $row[1]);
            $entity->setVille((string) $row[2]);
            $entity->setTelFixe((string) $row[3]);
            $entity->setTelPortable((string) $row[4]);
            $entity->setSiren((string) $row[5]);
            $entity->setRfN2((float) $row[6]);
            $entity->setRfN1((float) $row[7]);
            $entity->setIsN1((float) $row[8]);
            $entity->setLiquid((float) $row[9]);

            $this->em->persist($entity);
            $imported++;
        }

        $this->em->flush();
        return $imported;
    }
}
