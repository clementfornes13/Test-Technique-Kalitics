<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619202537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointage (id INT AUTO_INCREMENT NOT NULL, utilisateur VARCHAR(255) NOT NULL, chantier VARCHAR(255) NOT NULL, date DATE NOT NULL, duree TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY pointages_ibfk_1');
        $this->addSql('ALTER TABLE pointages DROP FOREIGN KEY pointages_ibfk_2');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE chantiers');
        $this->addSql('DROP TABLE pointages');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, matricule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chantiers (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_debut DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, chantier_id INT DEFAULT NULL, date_pointage DATE NOT NULL, duree NUMERIC(5, 2) NOT NULL, INDEX utilisateur_id (utilisateur_id), INDEX chantier_id (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT pointages_ibfk_1 FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pointages ADD CONSTRAINT pointages_ibfk_2 FOREIGN KEY (chantier_id) REFERENCES chantiers (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE pointage');
        $this->addSql('DROP TABLE `user`');
    }
}
