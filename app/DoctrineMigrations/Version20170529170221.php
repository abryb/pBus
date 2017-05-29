<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170529170221 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB97704ED06');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9816C6140');
        $this->addSql('DROP INDEX IDX_169E6FB97704ED06 ON course');
        $this->addSql('DROP INDEX IDX_169E6FB9816C6140 ON course');
        $this->addSql('ALTER TABLE course ADD departure_code INT DEFAULT NULL, ADD destination_code INT DEFAULT NULL, DROP departure_id, DROP destination_id');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB996996849 FOREIGN KEY (departure_code) REFERENCES station (code)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9D4B4B9A9 FOREIGN KEY (destination_code) REFERENCES station (code)');
        $this->addSql('CREATE INDEX IDX_169E6FB996996849 ON course (departure_code)');
        $this->addSql('CREATE INDEX IDX_169E6FB9D4B4B9A9 ON course (destination_code)');
        $this->addSql('ALTER TABLE connection ADD departure_code INT DEFAULT NULL, ADD destination_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE connection ADD CONSTRAINT FK_29F7736696996849 FOREIGN KEY (departure_code) REFERENCES station (code)');
        $this->addSql('ALTER TABLE connection ADD CONSTRAINT FK_29F77366D4B4B9A9 FOREIGN KEY (destination_code) REFERENCES station (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29F7736696996849 ON connection (departure_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29F77366D4B4B9A9 ON connection (destination_code)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE connection DROP FOREIGN KEY FK_29F7736696996849');
        $this->addSql('ALTER TABLE connection DROP FOREIGN KEY FK_29F77366D4B4B9A9');
        $this->addSql('DROP INDEX UNIQ_29F7736696996849 ON connection');
        $this->addSql('DROP INDEX UNIQ_29F77366D4B4B9A9 ON connection');
        $this->addSql('ALTER TABLE connection DROP departure_code, DROP destination_code');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB996996849');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9D4B4B9A9');
        $this->addSql('DROP INDEX IDX_169E6FB996996849 ON course');
        $this->addSql('DROP INDEX IDX_169E6FB9D4B4B9A9 ON course');
        $this->addSql('ALTER TABLE course ADD departure_id INT DEFAULT NULL, ADD destination_id INT DEFAULT NULL, DROP departure_code, DROP destination_code');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB97704ED06 FOREIGN KEY (departure_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9816C6140 FOREIGN KEY (destination_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_169E6FB97704ED06 ON course (departure_id)');
        $this->addSql('CREATE INDEX IDX_169E6FB9816C6140 ON course (destination_id)');
    }
}
