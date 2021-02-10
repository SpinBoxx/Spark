<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031180703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE civility (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, hex_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, user_id_id INT NOT NULL, INDEX IDX_68C58ED9DE18E50B (product_id_id), INDEX IDX_68C58ED99D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, id_buyer_id INT NOT NULL, id_seller_id INT NOT NULL, id_product_id INT NOT NULL, civility_id_id INT NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, delivery_address VARCHAR(255) NOT NULL, additional_address VARCHAR(255) NOT NULL, city VARCHAR(40) DEFAULT NULL, string VARCHAR(5) NOT NULL, country VARCHAR(30) NOT NULL, phone VARCHAR(10) NOT NULL, price DOUBLE PRECISION NOT NULL, email_address VARCHAR(100) NOT NULL, purchase_date DATETIME NOT NULL, INDEX IDX_F52993983CAEBBB7 (id_buyer_id), UNIQUE INDEX UNIQ_F5299398DDD9CFE (id_seller_id), UNIQUE INDEX UNIQ_F5299398E00EE68D (id_product_id), INDEX IDX_F529939866C085D1 (civility_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, state_id_id INT NOT NULL, gender_id_id INT DEFAULT NULL, size_id_id INT NOT NULL, type_id_id INT NOT NULL, color_primary_id_id INT NOT NULL, color_secondary_id_id INT DEFAULT NULL, brand_id_id INT NOT NULL, quality_id_id INT NOT NULL, category_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture_product LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', price DOUBLE PRECISION NOT NULL, link LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, update_datetime DATETIME DEFAULT NULL, INDEX IDX_D34A04AD9D86650F (user_id_id), INDEX IDX_D34A04ADDD71A5B (state_id_id), INDEX IDX_D34A04AD6F7F214C (gender_id_id), INDEX IDX_D34A04ADAE945C60 (size_id_id), INDEX IDX_D34A04AD714819A0 (type_id_id), INDEX IDX_D34A04AD6853797E (color_primary_id_id), INDEX IDX_D34A04ADD24FF022 (color_secondary_id_id), INDEX IDX_D34A04AD24BD5740 (brand_id_id), INDEX IDX_D34A04AD6BEA5664 (quality_id_id), INDEX IDX_D34A04AD9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quality (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, type_id_id INT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_F7C0246A714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(20) NOT NULL, phone VARCHAR(10) DEFAULT NULL, postal_address VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, department VARCHAR(40) DEFAULT NULL, country VARCHAR(40) DEFAULT NULL, picture_profil LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, update_datetime DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_68C58ED9DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_68C58ED99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983CAEBBB7 FOREIGN KEY (id_buyer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DDD9CFE FOREIGN KEY (id_seller_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939866C085D1 FOREIGN KEY (civility_id_id) REFERENCES civility (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDD71A5B FOREIGN KEY (state_id_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6F7F214C FOREIGN KEY (gender_id_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADAE945C60 FOREIGN KEY (size_id_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6853797E FOREIGN KEY (color_primary_id_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD24FF022 FOREIGN KEY (color_secondary_id_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD24BD5740 FOREIGN KEY (brand_id_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6BEA5664 FOREIGN KEY (quality_id_id) REFERENCES quality (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246A714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD24BD5740');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9777D11E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939866C085D1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6853797E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD24FF022');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6F7F214C');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_68C58ED9DE18E50B');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DDD9CFE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E00EE68D');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6BEA5664');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADAE945C60');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDD71A5B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD714819A0');
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246A714819A0');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_68C58ED99D86650F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993983CAEBBB7');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9D86650F');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE civility');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE quality');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
