<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127145717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mecanicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, specialiste VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite_stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece_service (piece_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_FD2B89BBC40FCFA8 (piece_id), INDEX IDX_FD2B89BBED5CA9E6 (service_id), PRIMARY KEY(piece_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, description LONGTEXT NOT NULL, date_demande DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_mecanicien (service_id INT NOT NULL, mecanicien_id INT NOT NULL, INDEX IDX_4E5AFA09ED5CA9E6 (service_id), INDEX IDX_4E5AFA09DCC2F5AE (mecanicien_id), PRIMARY KEY(service_id, mecanicien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piece_service ADD CONSTRAINT FK_FD2B89BBC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_service ADD CONSTRAINT FK_FD2B89BBED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE service_mecanicien ADD CONSTRAINT FK_4E5AFA09ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_mecanicien ADD CONSTRAINT FK_4E5AFA09DCC2F5AE FOREIGN KEY (mecanicien_id) REFERENCES mecanicien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_service DROP FOREIGN KEY FK_FD2B89BBC40FCFA8');
        $this->addSql('ALTER TABLE piece_service DROP FOREIGN KEY FK_FD2B89BBED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD219EB6921');
        $this->addSql('ALTER TABLE service_mecanicien DROP FOREIGN KEY FK_4E5AFA09ED5CA9E6');
        $this->addSql('ALTER TABLE service_mecanicien DROP FOREIGN KEY FK_4E5AFA09DCC2F5AE');
        $this->addSql('DROP TABLE mecanicien');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE piece_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_mecanicien');
    }
}
