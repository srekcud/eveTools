<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119205936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ravworks_stock (ravworks_stock_id UUID NOT NULL, ravworks_code VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, to_buy INT NOT NULL, to_buy_value BIGINT NOT NULL, to_buy_volume DOUBLE PRECISION NOT NULL, start_amount BIGINT NOT NULL, end_amount BIGINT NOT NULL, PRIMARY KEY(ravworks_stock_id))');
        $this->addSql('COMMENT ON COLUMN ravworks_stock.ravworks_stock_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE ravworks_stock');
    }
}
