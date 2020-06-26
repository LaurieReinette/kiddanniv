<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200626075743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, age_min SMALLINT NOT NULL, age_max SMALLINT DEFAULT NULL, price SMALLINT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_pro (delivery_id INT NOT NULL, pro_id INT NOT NULL, INDEX IDX_4C1BBD5B12136921 (delivery_id), INDEX IDX_4C1BBD5BC3B7E4BA (pro_id), PRIMARY KEY(delivery_id, pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_delivery_type (delivery_id INT NOT NULL, delivery_type_id INT NOT NULL, INDEX IDX_5AB0D85312136921 (delivery_id), INDEX IDX_5AB0D853CF52334D (delivery_type_id), PRIMARY KEY(delivery_id, delivery_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, forkids TINYINT(1) NOT NULL, foradults TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party (id INT AUTO_INCREMENT NOT NULL, organised_by_id INT NOT NULL, date DATE NOT NULL, hour_start TIME NOT NULL, hour_end TIME NOT NULL, child_age SMALLINT NOT NULL, children_number SMALLINT NOT NULL, place_type VARCHAR(50) NOT NULL, moderate TINYINT(1) DEFAULT NULL, INDEX IDX_89954EE09A82C896 (organised_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party_delivery (party_id INT NOT NULL, delivery_id INT NOT NULL, INDEX IDX_9B2FE4CF213C1059 (party_id), INDEX IDX_9B2FE4CF12136921 (delivery_id), PRIMARY KEY(party_id, delivery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party_pro (party_id INT NOT NULL, pro_id INT NOT NULL, INDEX IDX_12F66B2C213C1059 (party_id), INDEX IDX_12F66B2CC3B7E4BA (pro_id), PRIMARY KEY(party_id, pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pro (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(70) NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(70) NOT NULL, gender VARCHAR(10) DEFAULT NULL, firm VARCHAR(60) DEFAULT NULL, departement_shifting SMALLINT NOT NULL, mobilephone SMALLINT NOT NULL, otherphone SMALLINT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(60) NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(70) NOT NULL, gender VARCHAR(10) NOT NULL, postalcode SMALLINT NOT NULL, city VARCHAR(50) NOT NULL, departement SMALLINT NOT NULL, phone SMALLINT NOT NULL, mobilephone SMALLINT NOT NULL, otherphone SMALLINT DEFAULT NULL, moderate TINYINT(1) DEFAULT NULL, createdat DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delivery_pro ADD CONSTRAINT FK_4C1BBD5B12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_pro ADD CONSTRAINT FK_4C1BBD5BC3B7E4BA FOREIGN KEY (pro_id) REFERENCES pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_delivery_type ADD CONSTRAINT FK_5AB0D85312136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_delivery_type ADD CONSTRAINT FK_5AB0D853CF52334D FOREIGN KEY (delivery_type_id) REFERENCES delivery_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE09A82C896 FOREIGN KEY (organised_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE party_delivery ADD CONSTRAINT FK_9B2FE4CF213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party_delivery ADD CONSTRAINT FK_9B2FE4CF12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party_pro ADD CONSTRAINT FK_12F66B2C213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party_pro ADD CONSTRAINT FK_12F66B2CC3B7E4BA FOREIGN KEY (pro_id) REFERENCES pro (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery_pro DROP FOREIGN KEY FK_4C1BBD5B12136921');
        $this->addSql('ALTER TABLE delivery_delivery_type DROP FOREIGN KEY FK_5AB0D85312136921');
        $this->addSql('ALTER TABLE party_delivery DROP FOREIGN KEY FK_9B2FE4CF12136921');
        $this->addSql('ALTER TABLE delivery_delivery_type DROP FOREIGN KEY FK_5AB0D853CF52334D');
        $this->addSql('ALTER TABLE party_delivery DROP FOREIGN KEY FK_9B2FE4CF213C1059');
        $this->addSql('ALTER TABLE party_pro DROP FOREIGN KEY FK_12F66B2C213C1059');
        $this->addSql('ALTER TABLE delivery_pro DROP FOREIGN KEY FK_4C1BBD5BC3B7E4BA');
        $this->addSql('ALTER TABLE party_pro DROP FOREIGN KEY FK_12F66B2CC3B7E4BA');
        $this->addSql('ALTER TABLE party DROP FOREIGN KEY FK_89954EE09A82C896');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE delivery_pro');
        $this->addSql('DROP TABLE delivery_delivery_type');
        $this->addSql('DROP TABLE delivery_type');
        $this->addSql('DROP TABLE party');
        $this->addSql('DROP TABLE party_delivery');
        $this->addSql('DROP TABLE party_pro');
        $this->addSql('DROP TABLE pro');
        $this->addSql('DROP TABLE user');
    }
}
