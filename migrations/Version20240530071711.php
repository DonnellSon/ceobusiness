<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530071711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, call_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perso_infos (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, other_name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, perso_email VARCHAR(255) NOT NULL, pro_email VARCHAR(255) NOT NULL, perso_number INT NOT NULL, pro_number INT NOT NULL, whats_app VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nationality VARCHAR(255) NOT NULL, civility VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F62FA2557E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, file_size VARCHAR(255) NOT NULL, file_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pro_infos (id INT AUTO_INCREMENT NOT NULL, entreprise_name VARCHAR(255) NOT NULL, entreprise_title VARCHAR(255) NOT NULL, entreprise_size VARCHAR(255) NOT NULL, entreprise_activity VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_infos (id INT AUTO_INCREMENT NOT NULL, travel_assistance VARCHAR(255) NOT NULL, hotel_reservation VARCHAR(255) NOT NULL, airport_transfer VARCHAR(255) NOT NULL, other_travel_details VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perso_infos ADD CONSTRAINT FK_F62FA2557E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE user ADD perso_infos_id INT DEFAULT NULL, ADD pro_infos_id INT DEFAULT NULL, ADD confirmation_code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493BD6CAAF FOREIGN KEY (perso_infos_id) REFERENCES perso_infos (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64945BEEE50 FOREIGN KEY (pro_infos_id) REFERENCES pro_infos (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493BD6CAAF ON user (perso_infos_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64945BEEE50 ON user (pro_infos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6493BD6CAAF');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64945BEEE50');
        $this->addSql('ALTER TABLE perso_infos DROP FOREIGN KEY FK_F62FA2557E9E4C8C');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE perso_infos');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE pro_infos');
        $this->addSql('DROP TABLE travel_infos');
        $this->addSql('DROP INDEX UNIQ_8D93D6493BD6CAAF ON `user`');
        $this->addSql('DROP INDEX UNIQ_8D93D64945BEEE50 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP perso_infos_id, DROP pro_infos_id, DROP confirmation_code');
    }
}
