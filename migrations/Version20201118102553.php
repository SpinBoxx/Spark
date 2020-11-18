<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118102553 extends AbstractMigration
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
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_68C58ED94584665A (product_id), INDEX IDX_68C58ED9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, buyer_id INT NOT NULL, seller_id INT NOT NULL, product_id INT NOT NULL, civility_id INT NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, delivery_address VARCHAR(255) NOT NULL, additional_address VARCHAR(255) NOT NULL, city VARCHAR(40) DEFAULT NULL, string VARCHAR(5) NOT NULL, country VARCHAR(30) NOT NULL, phone VARCHAR(10) NOT NULL, price DOUBLE PRECISION NOT NULL, email_address VARCHAR(100) NOT NULL, purchase_date DATETIME NOT NULL, INDEX IDX_F52993986C755722 (buyer_id), UNIQUE INDEX UNIQ_F52993988DE820D9 (seller_id), UNIQUE INDEX UNIQ_F52993984584665A (product_id), INDEX IDX_F529939823D6A298 (civility_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, state_id INT NOT NULL, gender_id_id INT DEFAULT NULL, size_id INT NOT NULL, type_id INT NOT NULL, color_primary_id INT NOT NULL, color_secondary_id INT DEFAULT NULL, brand_id INT NOT NULL, quality_id INT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture_product LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', price DOUBLE PRECISION NOT NULL, link LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, update_datetime DATETIME DEFAULT NULL, INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04AD5D83CC1 (state_id), INDEX IDX_D34A04AD6F7F214C (gender_id_id), INDEX IDX_D34A04AD498DA827 (size_id), INDEX IDX_D34A04ADC54C8C93 (type_id), INDEX IDX_D34A04AD844CB7A2 (color_primary_id), INDEX IDX_D34A04ADCC572D5A (color_secondary_id), INDEX IDX_D34A04AD44F5D008 (brand_id), INDEX IDX_D34A04ADBCFC6D57 (quality_id), INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quality (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_F7C0246AC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(20) NOT NULL, phone VARCHAR(10) DEFAULT NULL, postal_address VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) DEFAULT NULL, city VARCHAR(40) DEFAULT NULL, department VARCHAR(40) DEFAULT NULL, country VARCHAR(40) DEFAULT NULL, picture_profil LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, update_datetime DATETIME DEFAULT NULL, is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986C755722 FOREIGN KEY (buyer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988DE820D9 FOREIGN KEY (seller_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939823D6A298 FOREIGN KEY (civility_id) REFERENCES civility (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6F7F214C FOREIGN KEY (gender_id_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD844CB7A2 FOREIGN KEY (color_primary_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCC572D5A FOREIGN KEY (color_secondary_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBCFC6D57 FOREIGN KEY (quality_id) REFERENCES quality (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939823D6A298');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD844CB7A2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCC572D5A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6F7F214C');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED94584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988DE820D9');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBCFC6D57');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD498DA827');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5D83CC1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246AC54C8C93');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986C755722');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE civility');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE favorite');
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
