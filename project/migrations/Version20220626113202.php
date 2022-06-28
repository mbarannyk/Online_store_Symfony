<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626113202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_order (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, INDEX IDX_56440F2FDC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_order ADD CONSTRAINT FK_56440F2FDC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD phone VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939819EB6921');
        $this->addSql('DROP INDEX IDX_F529939819EB6921 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD status_id_id INT NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD total_price NUMERIC(10, 0) NOT NULL, DROP client_id, DROP status');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_F5299398881ECFA7 ON `order` (status_id_id)');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('DROP INDEX IDX_2530ADE64584665A ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE68D9F6D38 ON order_product');
        $this->addSql('ALTER TABLE order_product ADD id INT AUTO_INCREMENT NOT NULL, ADD product_id_id INT NOT NULL, ADD order_id_id INT NOT NULL, ADD price NUMERIC(10, 0) NOT NULL, ADD count INT NOT NULL, ADD total_price NUMERIC(10, 0) NOT NULL, DROP order_id, DROP product_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6DE18E50B ON order_product (product_id_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6FCDAEAAA ON order_product (order_id_id)');
        $this->addSql('ALTER TABLE product CHANGE image image VARCHAR(255) NOT NULL, CHANGE price price NUMERIC(10, 0) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398881ECFA7');
        $this->addSql('DROP TABLE client_order');
        $this->addSql('DROP TABLE status');
        $this->addSql('ALTER TABLE client DROP phone, CHANGE password password VARCHAR(8) NOT NULL');
        $this->addSql('DROP INDEX IDX_F5299398881ECFA7 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD status INT NOT NULL, DROP adress, DROP total_price, CHANGE status_id_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F529939819EB6921 ON `order` (client_id)');
        $this->addSql('ALTER TABLE order_product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6DE18E50B');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FCDAEAAA');
        $this->addSql('DROP INDEX IDX_2530ADE6DE18E50B ON order_product');
        $this->addSql('DROP INDEX IDX_2530ADE6FCDAEAAA ON order_product');
        $this->addSql('ALTER TABLE order_product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE order_product ADD order_id INT NOT NULL, ADD product_id INT NOT NULL, DROP id, DROP product_id_id, DROP order_id_id, DROP price, DROP count, DROP total_price');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_2530ADE64584665A ON order_product (product_id)');
        $this->addSql('CREATE INDEX IDX_2530ADE68D9F6D38 ON order_product (order_id)');
        $this->addSql('ALTER TABLE order_product ADD PRIMARY KEY (order_id, product_id)');
        $this->addSql('ALTER TABLE product CHANGE image image LONGBLOB DEFAULT NULL, CHANGE price price INT NOT NULL');
    }
}
