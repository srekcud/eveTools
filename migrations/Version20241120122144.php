<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120122144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ravworks_job (ravworks_job_id UUID NOT NULL, ravworks_code VARCHAR(10) NOT NULL, job_type VARCHAR(50) NOT NULL, name VARCHAR(255) NOT NULL, run INT NOT NULL, time DOUBLE PRECISION NOT NULL, job_cost BIGINT NOT NULL, job_count INT NOT NULL, PRIMARY KEY(ravworks_job_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_job.ravworks_job_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE ravworks_job');
    }
}
