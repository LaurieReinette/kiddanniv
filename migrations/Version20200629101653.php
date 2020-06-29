<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629101653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro ADD address VARCHAR(255) NOT NULL, CHANGE mobilephone mobilephone INT NOT NULL, CHANGE otherphone otherphone INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE postalcode postalcode INT UNSIGNED NOT NULL, CHANGE mobilephone mobilephone INT NOT NULL, CHANGE otherphone otherphone INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro DROP address, CHANGE mobilephone mobilephone SMALLINT NOT NULL, CHANGE otherphone otherphone SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE postalcode postalcode SMALLINT UNSIGNED NOT NULL, CHANGE mobilephone mobilephone SMALLINT NOT NULL, CHANGE otherphone otherphone SMALLINT DEFAULT NULL');
    }
}
