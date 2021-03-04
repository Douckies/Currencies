<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304131903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apport (id INT AUTO_INCREMENT NOT NULL, plateforme VARCHAR(255) NOT NULL, apport VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crypto (id INT AUTO_INCREMENT NOT NULL, plateforme VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, qtt INT NOT NULL, investissement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL, exchange VARCHAR(255) NOT NULL, bought_currency VARCHAR(255) NOT NULL, bought_currency_qtt INT NOT NULL, sold_currency VARCHAR(255) NOT NULL, sold_currency_qtt INT NOT NULL, operation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apport');
        $this->addSql('DROP TABLE crypto');
        $this->addSql('DROP TABLE history');
    }
}
