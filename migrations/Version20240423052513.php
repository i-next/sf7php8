<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423052513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE breeder ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE breeder ADD CONSTRAINT FK_73DA3D7A9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_73DA3D7A9D86650F ON breeder (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE breeder DROP FOREIGN KEY FK_73DA3D7A9D86650F');
        $this->addSql('DROP INDEX IDX_73DA3D7A9D86650F ON breeder');
        $this->addSql('ALTER TABLE breeder DROP user_id_id');
    }
}
