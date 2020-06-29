<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629163710 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(3) NOT NULL, name VARCHAR(50) NOT NULL, region VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department_pro (department_id INT NOT NULL, pro_id INT NOT NULL, INDEX IDX_16A2F1DCAE80F5DF (department_id), INDEX IDX_16A2F1DCC3B7E4BA (pro_id), PRIMARY KEY(department_id, pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE department_pro ADD CONSTRAINT FK_16A2F1DCAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE department_pro ADD CONSTRAINT FK_16A2F1DCC3B7E4BA FOREIGN KEY (pro_id) REFERENCES pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party ADD department_id INT DEFAULT NULL, DROP departement_id');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE0AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_89954EE0AE80F5DF ON party (department_id)');
        $this->addSql('ALTER TABLE user ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AE80F5DF ON user (department_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE department_pro DROP FOREIGN KEY FK_16A2F1DCAE80F5DF');
        $this->addSql('ALTER TABLE party DROP FOREIGN KEY FK_89954EE0AE80F5DF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AE80F5DF');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE department_pro');
        $this->addSql('DROP INDEX IDX_89954EE0AE80F5DF ON party');
        $this->addSql('ALTER TABLE party ADD departement_id INT NOT NULL, DROP department_id');
        $this->addSql('DROP INDEX IDX_8D93D649AE80F5DF ON user');
        $this->addSql('ALTER TABLE user DROP department_id');
    }
}
