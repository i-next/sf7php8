<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403124506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE breeder (id INT NOT NULL, name VARCHAR(255) NOT NULL, url_photo VARCHAR(255) NOT NULL, name_id VARCHAR(255) NOT NULL, img VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE strain (id INT NOT NULL, breeder_id INT NOT NULL, name VARCHAR(255) NOT NULL, name_id VARCHAR(255) NOT NULL, auto BOOLEAN NOT NULL, duration INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A630CD7233C95BB1 ON strain (breeder_id)');
        $this->addSql('ALTER TABLE strain ADD CONSTRAINT FK_A630CD7233C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');

        $this->addSql('ALTER TABLE strain DROP CONSTRAINT FK_A630CD7233C95BB1');
        $this->addSql('DROP TABLE breeder');
        $this->addSql('DROP TABLE strain');
    }
}
