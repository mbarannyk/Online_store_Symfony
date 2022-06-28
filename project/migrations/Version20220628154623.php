<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628154623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_order ADD order_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE client_order ADD CONSTRAINT FK_56440F2FFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56440F2FFCDAEAAA ON client_order (order_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_order DROP FOREIGN KEY FK_56440F2FFCDAEAAA');
        $this->addSql('DROP INDEX UNIQ_56440F2FFCDAEAAA ON client_order');
        $this->addSql('ALTER TABLE client_order DROP order_id_id');
    }
}
