<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406145551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE my_seeds_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE my_seeds (id INT NOT NULL, strain_id INT DEFAULT NULL, userid_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, seeder VARCHAR(255) DEFAULT NULL, quantity INT NOT NULL, duration INT NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EEF5F1969B9E007 ON my_seeds (strain_id)');
        $this->addSql('CREATE INDEX IDX_9EEF5F1958E0A285 ON my_seeds (userid_id)');
        $this->addSql('ALTER TABLE my_seeds ADD CONSTRAINT FK_9EEF5F1969B9E007 FOREIGN KEY (strain_id) REFERENCES strain (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE my_seeds ADD CONSTRAINT FK_9EEF5F1958E0A285 FOREIGN KEY (userid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE breeder DROP img');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE my_seeds_id_seq CASCADE');
        $this->addSql('ALTER TABLE my_seeds DROP CONSTRAINT FK_9EEF5F1969B9E007');
        $this->addSql('ALTER TABLE my_seeds DROP CONSTRAINT FK_9EEF5F1958E0A285');
        $this->addSql('DROP TABLE my_seeds');
        $this->addSql('ALTER TABLE breeder ADD img VARCHAR(255) DEFAULT NULL');
    }
}
