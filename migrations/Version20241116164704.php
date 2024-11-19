<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116164704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory_type (inventory_type_id VARCHAR(10) NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(inventory_type_id, name))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C678980784482A6F ON inventory_type (inventory_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C67898075E237E06 ON inventory_type (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE inventory_type');
    }
}
