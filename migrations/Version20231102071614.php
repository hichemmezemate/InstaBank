<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102071614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget ADD libelle_id INT NOT NULL');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B25DD318D FOREIGN KEY (libelle_id) REFERENCES libelle (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_73F2F77B25DD318D ON budget (libelle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget DROP FOREIGN KEY FK_73F2F77B25DD318D');
        $this->addSql('DROP INDEX UNIQ_73F2F77B25DD318D ON budget');
        $this->addSql('ALTER TABLE budget DROP libelle_id');
    }
}
