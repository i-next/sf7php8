<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509162710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE growths (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, my_plants_id INT DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, date�_active DATETIME DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_4FCD78C358E0A285 (userid_id), UNIQUE INDEX UNIQ_4FCD78C38458103F (my_plants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE growths ADD CONSTRAINT FK_4FCD78C358E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE growths ADD CONSTRAINT FK_4FCD78C38458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE growths DROP FOREIGN KEY FK_4FCD78C358E0A285');
        $this->addSql('ALTER TABLE growths DROP FOREIGN KEY FK_4FCD78C38458103F');
        $this->addSql('DROP TABLE growths');
    }
}
