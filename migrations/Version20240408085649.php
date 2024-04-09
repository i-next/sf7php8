<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408085649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_seeds ADD breeder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_seeds ADD CONSTRAINT FK_9EEF5F1933C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9EEF5F1933C95BB1 ON my_seeds (breeder_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE my_seeds DROP CONSTRAINT FK_9EEF5F1933C95BB1');
        $this->addSql('DROP INDEX IDX_9EEF5F1933C95BB1');
        $this->addSql('ALTER TABLE my_seeds DROP breeder_id');
    }
}
