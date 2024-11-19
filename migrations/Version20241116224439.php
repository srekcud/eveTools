<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116224439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character (character_id VARCHAR(10) NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(character_id, name))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937AB0341136BE75 ON character (character_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937AB0345E237E06 ON character (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE character');
    }
}
