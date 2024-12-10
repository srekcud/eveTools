<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209162430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facility (facility_id VARCHAR(250) NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(facility_id, name))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_105994B2A7014910 ON facility (facility_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_105994B25E237E06 ON facility (name)');
        $this->addSql('CREATE INDEX f_name ON facility (name)');

        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163557025,\'F-3H2P - CEZ - T2 Research\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163563048,\'F-3H2P - CEZ - T2 Reactions\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163593786,\'F-3H2P - CEZ - T2 Copy & Invention\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163625240,\'F-3H2P - CEZ - T2 Components\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163637325,\'F-3H2P - CEZ - T1 Cap & Structures\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163727092,\'F-3H2P - CEZ - T2 Drones & Ammo\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163736062,\'F-3H2P - CEZ - T2 Ship M\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1047163845493,\'F-3H2P - CEZ - T2 Ship L\')');
        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(1045190678712,\'GR-J8B - RESEARCH - DO NOT USE\')');
//        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(,\'\')');
//        $this->addSql('INSERT INTO facility (facility_id, name) VALUES(,\'\')');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE facility');
    }
}
