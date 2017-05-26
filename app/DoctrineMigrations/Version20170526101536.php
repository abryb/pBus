<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170526101536 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB921BDB235');
        $this->addSql('DROP INDEX IDX_169E6FB921BDB235 ON course');
        $this->addSql('ALTER TABLE course ADD destination_id INT DEFAULT NULL, CHANGE station_id departure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB97704ED06 FOREIGN KEY (departure_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9816C6140 FOREIGN KEY (destination_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_169E6FB97704ED06 ON course (departure_id)');
        $this->addSql('CREATE INDEX IDX_169E6FB9816C6140 ON course (destination_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB97704ED06');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9816C6140');
        $this->addSql('DROP INDEX IDX_169E6FB97704ED06 ON course');
        $this->addSql('DROP INDEX IDX_169E6FB9816C6140 ON course');
        $this->addSql('ALTER TABLE course ADD station_id INT DEFAULT NULL, DROP departure_id, DROP destination_id');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB921BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_169E6FB921BDB235 ON course (station_id)');
    }
}
