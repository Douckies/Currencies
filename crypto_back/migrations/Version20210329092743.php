<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329092743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crypto ADD icone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE history CHANGE bought_currency_qtt bought_currency_qtt NUMERIC(20, 4) DEFAULT NULL, CHANGE sold_currency_qtt sold_currency_qtt NUMERIC(20, 4) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crypto DROP icone');
        $this->addSql('ALTER TABLE history CHANGE bought_currency_qtt bought_currency_qtt INT NOT NULL, CHANGE sold_currency_qtt sold_currency_qtt INT NOT NULL');
    }
}
