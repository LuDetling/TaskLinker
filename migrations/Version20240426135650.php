<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426135650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9F6203804 ON projet (statut_id)');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFC18272');
        $this->addSql('DROP INDEX IDX_E564F0BFC18272 ON statut');
        $this->addSql('ALTER TABLE statut DROP projet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9F6203804');
        $this->addSql('DROP INDEX IDX_50159CA9F6203804 ON projet');
        $this->addSql('ALTER TABLE projet DROP statut_id');
        $this->addSql('ALTER TABLE statut ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E564F0BFC18272 ON statut (projet_id)');
    }
}
