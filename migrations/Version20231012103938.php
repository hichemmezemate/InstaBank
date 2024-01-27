<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012103938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260C54C8C93 FOREIGN KEY (type_id) REFERENCES type_compte (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260C54C8C93 ON compte (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260C54C8C93');
        $this->addSql('DROP INDEX IDX_CFF65260C54C8C93 ON compte');
        $this->addSql('ALTER TABLE compte DROP type_id');
    }
}
