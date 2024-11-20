<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119164020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ravworks_project_retrieve (ravworks_project_retrieve_id UUID NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creation_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, errors JSON DEFAULT NULL, PRIMARY KEY(ravworks_project_retrieve_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_project_retrieve.ravworks_project_retrieve_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE ravworks_project_retrieve');
    }
}
