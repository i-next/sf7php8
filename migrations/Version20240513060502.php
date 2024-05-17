<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513060502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blooms DROP INDEX IDX_91ADCB9A8458103F, ADD UNIQUE INDEX UNIQ_91ADCB9A8458103F (my_plants_id)');
        $this->addSql('ALTER TABLE harvests DROP INDEX IDX_A385D7DF8458103F, ADD UNIQUE INDEX UNIQ_A385D7DF8458103F (my_plants_id)');
        $this->addSql('ALTER TABLE my_plants DROP FOREIGN KEY FK_39CB1C0DB313F2BA');
        $this->addSql('DROP INDEX UNIQ_39CB1C0DB313F2BA ON my_plants');
        $this->addSql('ALTER TABLE my_plants DROP germination_id');
        $this->addSql('ALTER TABLE preblooms DROP INDEX IDX_13E48ED8458103F, ADD UNIQUE INDEX UNIQ_13E48ED8458103F (my_plants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blooms DROP INDEX UNIQ_91ADCB9A8458103F, ADD INDEX IDX_91ADCB9A8458103F (my_plants_id)');
        $this->addSql('ALTER TABLE harvests DROP INDEX UNIQ_A385D7DF8458103F, ADD INDEX IDX_A385D7DF8458103F (my_plants_id)');
        $this->addSql('ALTER TABLE my_plants ADD germination_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_plants ADD CONSTRAINT FK_39CB1C0DB313F2BA FOREIGN KEY (germination_id) REFERENCES germination (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39CB1C0DB313F2BA ON my_plants (germination_id)');
        $this->addSql('ALTER TABLE preblooms DROP INDEX UNIQ_13E48ED8458103F, ADD INDEX IDX_13E48ED8458103F (my_plants_id)');
    }
}
