<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181103144732 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE ip_address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ip_address (id INT NOT NULL, country_code VARCHAR(100) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, country_rus VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, region_rus VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, city_rus VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, time_zone VARCHAR(255) DEFAULT NULL, time_created INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ip_address_id_seq CASCADE');
        $this->addSql('DROP TABLE ip_address');
    }
}
