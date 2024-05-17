<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510054440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blooms (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, my_plants_id INT DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, date_active DATETIME DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_91ADCB9A58E0A285 (userid_id), INDEX IDX_91ADCB9A8458103F (my_plants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE harvests (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, my_plants_id INT DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, date_active DATETIME DEFAULT NULL, weight SMALLINT DEFAULT NULL, notes LONGTEXT DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_A385D7DF58E0A285 (userid_id), INDEX IDX_A385D7DF8458103F (my_plants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preblooms (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, my_plants_id INT DEFAULT NULL, finished TINYINT(1) DEFAULT NULL, date_active DATETIME DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME NOT NULL, INDEX IDX_13E48ED58E0A285 (userid_id), INDEX IDX_13E48ED8458103F (my_plants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blooms ADD CONSTRAINT FK_91ADCB9A58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE blooms ADD CONSTRAINT FK_91ADCB9A8458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
        $this->addSql('ALTER TABLE harvests ADD CONSTRAINT FK_A385D7DF58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE harvests ADD CONSTRAINT FK_A385D7DF8458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
        $this->addSql('ALTER TABLE preblooms ADD CONSTRAINT FK_13E48ED58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE preblooms ADD CONSTRAINT FK_13E48ED8458103F FOREIGN KEY (my_plants_id) REFERENCES my_plants (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blooms DROP FOREIGN KEY FK_91ADCB9A58E0A285');
        $this->addSql('ALTER TABLE blooms DROP FOREIGN KEY FK_91ADCB9A8458103F');
        $this->addSql('ALTER TABLE harvests DROP FOREIGN KEY FK_A385D7DF58E0A285');
        $this->addSql('ALTER TABLE harvests DROP FOREIGN KEY FK_A385D7DF8458103F');
        $this->addSql('ALTER TABLE preblooms DROP FOREIGN KEY FK_13E48ED58E0A285');
        $this->addSql('ALTER TABLE preblooms DROP FOREIGN KEY FK_13E48ED8458103F');
        $this->addSql('DROP TABLE blooms');
        $this->addSql('DROP TABLE harvests');
        $this->addSql('DROP TABLE preblooms');
    }
}
