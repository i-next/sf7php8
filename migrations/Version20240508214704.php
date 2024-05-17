<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508214704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination DROP INDEX IDX_D3AB66E88458103F, ADD UNIQUE INDEX UNIQ_D3AB66E88458103F (my_plants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE germination DROP INDEX UNIQ_D3AB66E88458103F, ADD INDEX IDX_D3AB66E88458103F (my_plants_id)');
    }
}
