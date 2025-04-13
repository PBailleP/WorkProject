<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413085720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE dinosaurs_scientist (dinosaurs_id INT NOT NULL, scientist_id INT NOT NULL, INDEX IDX_83B672A785AEBC (dinosaurs_id), INDEX IDX_83B672A7EBA327D6 (scientist_id), PRIMARY KEY(dinosaurs_id, scientist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE scientist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, field_of_study VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs_scientist ADD CONSTRAINT FK_83B672A785AEBC FOREIGN KEY (dinosaurs_id) REFERENCES dinosaurs (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs_scientist ADD CONSTRAINT FK_83B672A7EBA327D6 FOREIGN KEY (scientist_id) REFERENCES scientist (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs ADD period_id INT DEFAULT NULL, ADD species_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs ADD CONSTRAINT FK_B1DE6E91EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs ADD CONSTRAINT FK_B1DE6E91B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B1DE6E91EC8B7ADE ON dinosaurs (period_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B1DE6E91B2A1D860 ON dinosaurs (species_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs DROP FOREIGN KEY FK_B1DE6E91EC8B7ADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs DROP FOREIGN KEY FK_B1DE6E91B2A1D860
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs_scientist DROP FOREIGN KEY FK_83B672A785AEBC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs_scientist DROP FOREIGN KEY FK_83B672A7EBA327D6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE dinosaurs_scientist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE period
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE scientist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE species
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B1DE6E91EC8B7ADE ON dinosaurs
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B1DE6E91B2A1D860 ON dinosaurs
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dinosaurs DROP period_id, DROP species_id
        SQL);
    }
}
