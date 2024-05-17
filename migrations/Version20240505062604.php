<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505062604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE my_plants (id INT AUTO_INCREMENT NOT NULL, my_seeds_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, duration INT DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_39CB1C0D7820E323 (my_seeds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE my_plants ADD CONSTRAINT FK_39CB1C0D7820E323 FOREIGN KEY (my_seeds_id) REFERENCES my_seeds (id)');
        $this->addSql('ALTER TABLE breeder ADD CONSTRAINT FK_73DA3D7A9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_73DA3D7A9D86650F ON breeder (user_id_id)');
        $this->addSql('ALTER TABLE strain CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE strain ADD CONSTRAINT FK_A630CD7233C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_plants DROP FOREIGN KEY FK_39CB1C0D7820E323');
        $this->addSql('DROP TABLE my_plants');
        $this->addSql('ALTER TABLE breeder DROP FOREIGN KEY FK_73DA3D7A9D86650F');
        $this->addSql('DROP INDEX IDX_73DA3D7A9D86650F ON breeder');
        $this->addSql('ALTER TABLE strain DROP FOREIGN KEY FK_A630CD7233C95BB1');
        $this->addSql('ALTER TABLE strain CHANGE description description TEXT DEFAULT NULL');
    }
}
