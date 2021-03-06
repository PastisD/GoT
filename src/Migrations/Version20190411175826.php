<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411175826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0FF03E368');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0A76ED395');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0FF03E368 FOREIGN KEY (charac_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0A76ED395');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0FF03E368');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0FF03E368 FOREIGN KEY (charac_id) REFERENCES `character` (id)');
    }
}
