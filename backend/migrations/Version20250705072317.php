<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250705072317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE is2024 (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, nom VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, tel_fixe VARCHAR(20) NOT NULL, tel_portable VARCHAR(20) NOT NULL, siren VARCHAR(20) NOT NULL, rf_n2 DOUBLE PRECISION DEFAULT NULL, rf_n1 DOUBLE PRECISION DEFAULT NULL, is_n1 DOUBLE PRECISION DEFAULT NULL, liquid DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE is2024');
    }
}
