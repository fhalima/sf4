<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191208002734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, label_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, release_at DATETIME NOT NULL, INDEX IDX_9B349F91B7970CF8 (artist_id), INDEX IDX_9B349F9133B92F39 (label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9133B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');

       /* $this->addSql('ALTER TABLE record CHANGE label_id label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(40) NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('UPDATE user SET pseudo = CONCAT("user_", id)');
        $this->addSql('ALTER TABLE user CHANGE pseudo pseudo VARCHAR(40) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
        Si on ajoute la collonne pseudo dans une table et il faut quil soit unique on le met au default null
       puis on lui affecte une valeur unique exemple: id puis on remet le not null
       */
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F91B7970CF8');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F9133B92F39');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE user');
    }
}
