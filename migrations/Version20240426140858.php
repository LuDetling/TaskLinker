<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426140858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut_projet (statut_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_E79A3DFDF6203804 (statut_id), INDEX IDX_E79A3DFDC18272 (projet_id), PRIMARY KEY(statut_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statut_projet ADD CONSTRAINT FK_E79A3DFDF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statut_projet ADD CONSTRAINT FK_E79A3DFDC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFC18272');
        $this->addSql('DROP INDEX IDX_E564F0BFC18272 ON statut');
        $this->addSql('ALTER TABLE statut DROP projet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statut_projet DROP FOREIGN KEY FK_E79A3DFDF6203804');
        $this->addSql('ALTER TABLE statut_projet DROP FOREIGN KEY FK_E79A3DFDC18272');
        $this->addSql('DROP TABLE statut_projet');
        $this->addSql('ALTER TABLE statut ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E564F0BFC18272 ON statut (projet_id)');
    }
}
