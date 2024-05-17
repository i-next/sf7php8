<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240422061420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       /* $this->addSql('ALTER TABLE my_seeds DROP FOREIGN KEY FK_9EEF5F1933C95BB1');
        $this->addSql('DROP INDEX IDX_9EEF5F1933C95BB1 ON my_seeds');
        $this->addSql('ALTER TABLE my_seeds DROP breeder_id, DROP name, DROP seeder, DROP duration, DROP description');*/
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_seeds ADD breeder_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL, ADD seeder VARCHAR(255) DEFAULT NULL, ADD duration INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_seeds ADD CONSTRAINT FK_9EEF5F1933C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9EEF5F1933C95BB1 ON my_seeds (breeder_id)');
    }
}
