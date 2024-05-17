<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513061024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination ADD my_plants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE germination ADD CONSTRAINT FK_D3AB66E88458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D3AB66E88458103F ON germination (my_plants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination DROP FOREIGN KEY FK_D3AB66E88458103F');
        $this->addSql('DROP INDEX UNIQ_D3AB66E88458103F ON germination');
        $this->addSql('ALTER TABLE germination DROP my_plants_id');
    }
}
