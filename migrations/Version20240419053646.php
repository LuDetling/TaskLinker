<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240419053646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE creneau (id INT AUTO_INCREMENT NOT NULL, employe_id_id INT DEFAULT NULL, tache_id_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, UNIQUE INDEX UNIQ_F9668B5F325980C0 (employe_id_id), UNIQUE INDEX UNIQ_F9668B5FE0894996 (tache_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette_tache (etiquette_id INT NOT NULL, tache_id INT NOT NULL, INDEX IDX_2F3DEBC27BD2EA57 (etiquette_id), INDEX IDX_2F3DEBC2D2235D39 (tache_id), PRIMARY KEY(etiquette_id, tache_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, tache_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_7B00651CD2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, employe_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, deadline DATETIME NOT NULL, UNIQUE INDEX UNIQ_93872075325980C0 (employe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5F325980C0 FOREIGN KEY (employe_id_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE creneau ADD CONSTRAINT FK_F9668B5FE0894996 FOREIGN KEY (tache_id_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE etiquette_tache ADD CONSTRAINT FK_2F3DEBC27BD2EA57 FOREIGN KEY (etiquette_id) REFERENCES etiquette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etiquette_tache ADD CONSTRAINT FK_2F3DEBC2D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075325980C0 FOREIGN KEY (employe_id_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE projet ADD tache_id INT DEFAULT NULL, ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA96BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9D2235D39 ON projet (tache_id)');
        $this->addSql('CREATE INDEX IDX_50159CA96BF700BD ON projet (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA96BF700BD');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9D2235D39');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5F325980C0');
        $this->addSql('ALTER TABLE creneau DROP FOREIGN KEY FK_F9668B5FE0894996');
        $this->addSql('ALTER TABLE etiquette_tache DROP FOREIGN KEY FK_2F3DEBC27BD2EA57');
        $this->addSql('ALTER TABLE etiquette_tache DROP FOREIGN KEY FK_2F3DEBC2D2235D39');
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651CD2235D39');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075325980C0');
        $this->addSql('DROP TABLE creneau');
        $this->addSql('DROP TABLE etiquette');
        $this->addSql('DROP TABLE etiquette_tache');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP INDEX IDX_50159CA9D2235D39 ON projet');
        $this->addSql('DROP INDEX IDX_50159CA96BF700BD ON projet');
        $this->addSql('ALTER TABLE projet DROP tache_id, DROP status_id');
    }
}
