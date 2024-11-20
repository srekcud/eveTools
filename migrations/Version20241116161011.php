<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116161011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE industry_activity (industry_activity_id VARCHAR(2) NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(industry_activity_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C2C13DF5E237E06 ON industry_activity (name)');

        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(1,\'Manufacturing\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(2,\'Researching Technology\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(3,\'Researching Time Efficiency\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(4,\'Researching Material Efficiency\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(5,\'Copying\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(8,\'Invention\')');
        $this->addSql('INSERT INTO industry_activity (industry_activity_id, name) VALUES(9, \'Reactions\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE industry_activity');
    }
}
