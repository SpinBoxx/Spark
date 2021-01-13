<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102190419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE civility (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, id_buyer_id INT NOT NULL, id_seller_id INT NOT NULL, id_product_id INT NOT NULL, civility_id_id INT NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, delivery_address VARCHAR(255) NOT NULL, additional_address VARCHAR(255) NOT NULL, city VARCHAR(40) DEFAULT NULL, string VARCHAR(5) NOT NULL, country VARCHAR(30) NOT NULL, phone VARCHAR(10) NOT NULL, price DOUBLE PRECISION NOT NULL, email_address VARCHAR(100) NOT NULL, purchase_date DATETIME NOT NULL, INDEX IDX_F52993983CAEBBB7 (id_buyer_id), UNIQUE INDEX UNIQ_F5299398DDD9CFE (id_seller_id), UNIQUE INDEX UNIQ_F5299398E00EE68D (id_product_id), INDEX IDX_F529939866C085D1 (civility_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983CAEBBB7 FOREIGN KEY (id_buyer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DDD9CFE FOREIGN KEY (id_seller_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939866C085D1 FOREIGN KEY (civility_id_id) REFERENCES civility (id)');
        $this->addSql('ALTER TABLE product CHANGE picture_product picture_product LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('
            INSERT INTO user (email, password, username, firstname, lastname)
            VALUES
                (\'admin@admin.com\',  \'$argon2id$v=19$m=65536,t=4,p=1$vXDWeyV4UpECkr6/FPbPzw$nz3qqX3kGOiojADO65zWR3xo5FMDcPjgPECZGFDhA1I\', "mimo", "mariomn", "marion");
            '
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939866C085D1');
        $this->addSql('DROP TABLE civility');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE product CHANGE picture_product picture_product VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
