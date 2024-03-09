<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304153444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE seed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE seed (id INT NOT NULL, seeder_id INT DEFAULT NULL, userid_id INT NOT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, duration INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4487E306F423E767 ON seed (seeder_id)');
        $this->addSql('CREATE INDEX IDX_4487E30658E0A285 ON seed (userid_id)');
        $this->addSql('ALTER TABLE seed ADD CONSTRAINT FK_4487E306F423E767 FOREIGN KEY (seeder_id) REFERENCES seeder (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seed ADD CONSTRAINT FK_4487E30658E0A285 FOREIGN KEY (userid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE seed_id_seq CASCADE');
        $this->addSql('ALTER TABLE seed DROP CONSTRAINT FK_4487E306F423E767');
        $this->addSql('ALTER TABLE seed DROP CONSTRAINT FK_4487E30658E0A285');
        $this->addSql('DROP TABLE seed');
    }
}
