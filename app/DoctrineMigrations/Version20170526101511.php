<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170526101511 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course ADD station_id INT DEFAULT NULL, DROP Departure, DROP Destination');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB921BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_169E6FB921BDB235 ON course (station_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB921BDB235');
        $this->addSql('DROP INDEX IDX_169E6FB921BDB235 ON course');
        $this->addSql('ALTER TABLE course ADD Departure INT NOT NULL, ADD Destination INT NOT NULL, DROP station_id');
    }
}
