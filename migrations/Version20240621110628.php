<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621110628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX idbrand_UNIQUE ON brand');
        $this->addSql('ALTER TABLE brand CHANGE name name VARCHAR(128) NOT NULL');
        $this->addSql('DROP INDEX idcategory_UNIQUE ON category');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(128) NOT NULL');
        $this->addSql('DROP INDEX idproduct_UNIQUE ON product');
        $this->addSql('ALTER TABLE product DROP count, CHANGE short_description short_description LONGTEXT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE facebook facebooh TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE product RENAME INDEX fk_product_brand_idx TO IDX_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product RENAME INDEX fk_product_category1_idx TO IDX_D34A04AD12469DE2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE brand CHANGE name name VARCHAR(45) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX idbrand_UNIQUE ON brand (id)');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(45) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX idcategory_UNIQUE ON category (id)');
        $this->addSql('ALTER TABLE product ADD count DOUBLE PRECISION DEFAULT NULL, CHANGE short_description short_description VARCHAR(255) DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE facebooh facebook TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX idproduct_UNIQUE ON product (id)');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ad44f5d008 TO fk_product_brand_idx');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ad12469de2 TO fk_product_category1_idx');
    }
}
