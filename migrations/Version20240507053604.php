<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507053604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination ADD userid_id INT NOT NULL');
        $this->addSql('ALTER TABLE germination ADD CONSTRAINT FK_D3AB66E858E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D3AB66E858E0A285 ON germination (userid_id)');
        $this->addSql('ALTER TABLE my_plants ADD userid_id INT NOT NULL');
        $this->addSql('ALTER TABLE my_plants ADD CONSTRAINT FK_39CB1C0D58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_39CB1C0D58E0A285 ON my_plants (userid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_plants DROP FOREIGN KEY FK_39CB1C0D58E0A285');
        $this->addSql('DROP INDEX IDX_39CB1C0D58E0A285 ON my_plants');
        $this->addSql('ALTER TABLE my_plants DROP userid_id');
        $this->addSql('ALTER TABLE germination DROP FOREIGN KEY FK_D3AB66E858E0A285');
        $this->addSql('DROP INDEX IDX_D3AB66E858E0A285 ON germination');
        $this->addSql('ALTER TABLE germination DROP userid_id');
    }
}
