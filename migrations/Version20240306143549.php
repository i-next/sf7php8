<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306143549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE plant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plant_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plant (id INT NOT NULL, userid_id INT NOT NULL, seedid_id INT NOT NULL, state VARCHAR(255) NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_flo DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB030D7258E0A285 ON plant (userid_id)');
        $this->addSql('CREATE INDEX IDX_AB030D7244A10225 ON plant (seedid_id)');
        $this->addSql('CREATE TABLE plant_history (id INT NOT NULL, plant_id_id INT NOT NULL, state VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D33BA328C9E07DF ON plant_history (plant_id_id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7258E0A285 FOREIGN KEY (userid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7244A10225 FOREIGN KEY (seedid_id) REFERENCES seed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plant_history ADD CONSTRAINT FK_5D33BA328C9E07DF FOREIGN KEY (plant_id_id) REFERENCES plant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plant_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT FK_AB030D7258E0A285');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT FK_AB030D7244A10225');
        $this->addSql('ALTER TABLE plant_history DROP CONSTRAINT FK_5D33BA328C9E07DF');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE plant_history');
    }
}
