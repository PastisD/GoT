<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412103524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll ADD throne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA4579E793CB FOREIGN KEY (throne_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_84BCFA4579E793CB ON poll (throne_id)');
        $this->addSql('ALTER TABLE poll_character DROP throne');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA4579E793CB');
        $this->addSql('DROP INDEX IDX_84BCFA4579E793CB ON poll');
        $this->addSql('ALTER TABLE poll DROP throne_id');
        $this->addSql('ALTER TABLE poll_character ADD throne TINYINT(1) NOT NULL');
    }
}
