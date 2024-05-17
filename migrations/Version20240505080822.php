<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505080822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE germination (id INT AUTO_INCREMENT NOT NULL, my_plants_id INT NOT NULL, finished TINYINT(1) NOT NULL, date_germination DATETIME NOT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_D3AB66E88458103F (my_plants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE germination ADD CONSTRAINT FK_D3AB66E88458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination DROP FOREIGN KEY FK_D3AB66E88458103F');
        $this->addSql('DROP TABLE germination');
    }
}
