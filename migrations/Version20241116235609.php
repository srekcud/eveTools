<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116235609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character ALTER character_id TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE industry_job ALTER installer_id TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE industry_job ALTER facility_id TYPE VARCHAR(50)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE industry_job ALTER installer_id TYPE BIGINT');
        $this->addSql('ALTER TABLE industry_job ALTER installer_id TYPE BIGINT');
        $this->addSql('ALTER TABLE industry_job ALTER facility_id TYPE BIGINT');
        $this->addSql('ALTER TABLE industry_job ALTER facility_id TYPE BIGINT');
        $this->addSql('ALTER TABLE character ALTER character_id TYPE VARCHAR(10)');
    }
}
