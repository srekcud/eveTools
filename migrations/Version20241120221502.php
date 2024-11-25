<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120221502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character (character_id VARCHAR(15) NOT NULL, name VARCHAR(250) NOT NULL, refresh_token VARCHAR(1024) DEFAULT NULL, PRIMARY KEY(character_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937AB0345E237E06 ON character (name)');
        $this->addSql('CREATE TABLE industry_job (industry_job_id BIGINT NOT NULL, output_location_id VARCHAR(50) NOT NULL, activity_id VARCHAR(50) NOT NULL, blueprint_type_id VARCHAR(50) NOT NULL, runs INT NOT NULL, duration BIGINT NOT NULL, installer_id VARCHAR(15) NOT NULL, cost BIGINT NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, facility_id VARCHAR(50) NOT NULL, probability DOUBLE PRECISION NOT NULL, successful INT DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(industry_job_id))');
        $this->addSql('COMMENT ON COLUMN industry_job.start_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN industry_job.end_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN industry_job.completed_datetime IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE industry_job_retrieve (industry_jobs_retrieve_id UUID NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creation_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, errors JSON DEFAULT NULL, PRIMARY KEY(industry_jobs_retrieve_id))');
        $this->addSql('COMMENT ON COLUMN industry_job_retrieve.industry_jobs_retrieve_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE industry_ravworks_link (industry_ravworks_link_id UUID NOT NULL, industry_job_id BIGINT NOT NULL, ravworks_job_id UUID NOT NULL, PRIMARY KEY(industry_ravworks_link_id))');
        $this->addSql('COMMENT ON COLUMN industry_ravworks_link.industry_ravworks_link_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN industry_ravworks_link.ravworks_job_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE inventory_type (inventory_type_id VARCHAR(10) NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(inventory_type_id, name))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C678980784482A6F ON inventory_type (inventory_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C67898075E237E06 ON inventory_type (name)');
        $this->addSql('CREATE TABLE project (project_id UUID NOT NULL, name VARCHAR(255) DEFAULT NULL, ravworks_id VARCHAR(10) DEFAULT NULL, PRIMARY KEY(project_id))');
        $this->addSql('COMMENT ON COLUMN project.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE ravworks_job (ravworks_job_id UUID NOT NULL, ravworks_code VARCHAR(10) NOT NULL, job_type VARCHAR(50) NOT NULL, name VARCHAR(255) NOT NULL, run INT NOT NULL, me INT DEFAULT NULL, time DOUBLE PRECISION NOT NULL, job_cost BIGINT NOT NULL, job_count INT NOT NULL, PRIMARY KEY(ravworks_job_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_job.ravworks_job_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE ravworks_project_retrieve (ravworks_project_retrieve_id UUID NOT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creation_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, errors JSON DEFAULT NULL, PRIMARY KEY(ravworks_project_retrieve_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_project_retrieve.ravworks_project_retrieve_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE ravworks_stock (ravworks_stock_id UUID NOT NULL, ravworks_code VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, to_buy INT NOT NULL, to_buy_value BIGINT NOT NULL, to_buy_volume DOUBLE PRECISION NOT NULL, start_amount BIGINT NOT NULL, end_amount BIGINT NOT NULL, PRIMARY KEY(ravworks_stock_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_stock.ravworks_stock_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE character');
        $this->addSql('DROP TABLE industry_job');
        $this->addSql('DROP TABLE industry_job_retrieve');
        $this->addSql('DROP TABLE industry_ravworks_link');
        $this->addSql('DROP TABLE inventory_type');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE ravworks_job');
        $this->addSql('DROP TABLE ravworks_project_retrieve');
        $this->addSql('DROP TABLE ravworks_stock');
    }
}
