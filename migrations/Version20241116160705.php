<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116160705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE industry_job (industry_job_id BIGINT NOT NULL, output_location_id VARCHAR(50) NOT NULL, activity_id VARCHAR(50) NOT NULL, blueprint_type_id VARCHAR(50) NOT NULL, runs INT NOT NULL, duration BIGINT NOT NULL, installer_id BIGINT NOT NULL, cost BIGINT NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, facility_id BIGINT NOT NULL, probability DOUBLE PRECISION NOT NULL, successful INT DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(industry_job_id))');
        $this->addSql('COMMENT ON COLUMN industry_job.start_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN industry_job.end_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN industry_job.completed_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE industry_jobs_retrieve (industry_jobs_retrieve_id UUID NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creation_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, errors JSON DEFAULT NULL, PRIMARY KEY(industry_jobs_retrieve_id))');
        $this->addSql('COMMENT ON COLUMN industry_jobs_retrieve.industry_jobs_retrieve_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE industry_job');
        $this->addSql('DROP TABLE industry_jobs_retrieve');
    }
}
