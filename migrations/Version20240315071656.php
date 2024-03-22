<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240315071656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE recolte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recolte (id INT NOT NULL, plant_id INT NOT NULL, userid_id INT NOT NULL, weight SMALLINT DEFAULT NULL, notes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3433713C1D935652 ON recolte (plant_id)');
        $this->addSql('CREATE INDEX IDX_3433713C58E0A285 ON recolte (userid_id)');
        $this->addSql('ALTER TABLE recolte ADD CONSTRAINT FK_3433713C1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recolte ADD CONSTRAINT FK_3433713C58E0A285 FOREIGN KEY (userid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE recolte_id_seq CASCADE');
        $this->addSql('ALTER TABLE recolte DROP CONSTRAINT FK_3433713C1D935652');
        $this->addSql('ALTER TABLE recolte DROP CONSTRAINT FK_3433713C58E0A285');
        $this->addSql('DROP TABLE recolte');
    }
}
