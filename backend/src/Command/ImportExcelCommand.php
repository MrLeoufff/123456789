<?php

namespace App\Command;

use App\Service\BilanImportService;
use App\Service\FiscaliteImportService;
use App\Service\Is2024ImportService;
use App\Service\PortefeuilleImportService;
use App\Service\SuiviProductionImportService;
use App\Service\TvaImportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-excel',
    description: 'Importe toutes les feuilles Excel dans la base de données.',
)]
class ImportExcelCommand extends Command
{
    public function __construct(
        private readonly Is2024ImportService $is2024Service,
        private readonly BilanImportService $bilanService,
        private readonly FiscaliteImportService $fiscaliteService,
        private readonly PortefeuilleImportService $portefeuilleService,
        private readonly SuiviProductionImportService $suiviService,
        private readonly TvaImportService $tvaService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'Chemin vers le fichier Excel (.xlsx)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        $output->writeln("<info>Import du fichier : $file</info>");

        $importCounts = [
            'IS 2024' => $this->is2024Service->import($file),
            'Bilan' => $this->bilanService->import($file),
            'Fiscalité' => $this->fiscaliteService->import($file),
            'Portefeuille' => $this->portefeuilleService->import($file),
            'Suivi Production' => $this->suiviService->import($file),
            'TVA' => $this->tvaService->import($file),
        ];

        foreach ($importCounts as $sheet => $count) {
            $output->writeln("<comment>$sheet : $count lignes importées.</comment>");
        }

        $output->writeln('<info>Import terminé avec succès !</info>');

        return Command::SUCCESS;
    }
}
