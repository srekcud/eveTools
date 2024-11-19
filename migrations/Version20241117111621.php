<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117111621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (projectid UUID NOT NULL, PRIMARY KEY(projectid))');
        $this->addSql('COMMENT ON COLUMN project.projectid IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP INDEX uniq_937ab0341136be75');
        $this->addSql('ALTER TABLE character DROP CONSTRAINT character_pkey');
        $this->addSql('ALTER TABLE character ADD refresh_token VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE character ADD PRIMARY KEY (character_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP INDEX character_pkey');
        $this->addSql('ALTER TABLE character DROP refresh_token');
        $this->addSql('CREATE UNIQUE INDEX uniq_937ab0341136be75 ON character (character_id)');
        $this->addSql('ALTER TABLE character ADD PRIMARY KEY (character_id, name)');
    }
}
