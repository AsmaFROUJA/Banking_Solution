<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523170303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (numero INT AUTO_INCREMENT NOT NULL, cin INT NOT NULL, solde DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, statu VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF65260ABE530DA (cin), PRIMARY KEY(numero)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit (idcredit INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, cause VARCHAR(255) NOT NULL, cin INT NOT NULL, UNIQUE INDEX UNIQ_1CC16EFEF55AE19E (numero), PRIMARY KEY(idcredit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (cin INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, PRIMARY KEY(cin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260ABE530DA FOREIGN KEY (cin) REFERENCES etudiant (cin)');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFEF55AE19E FOREIGN KEY (numero) REFERENCES compte (numero)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260ABE530DA');
        $this->addSql('ALTER TABLE credit DROP FOREIGN KEY FK_1CC16EFEF55AE19E');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE credit');
        $this->addSql('DROP TABLE etudiant');
    }
}
