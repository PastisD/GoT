<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412102950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE poll (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_84BCFA45A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_character (id INT AUTO_INCREMENT NOT NULL, charac_id INT NOT NULL, poll_id INT NOT NULL, dead TINYINT(1) NOT NULL, white_walker TINYINT(1) NOT NULL, throne TINYINT(1) NOT NULL, INDEX IDX_58AD99C0FF03E368 (charac_id), INDEX IDX_58AD99C03C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poll_character ADD CONSTRAINT FK_58AD99C0FF03E368 FOREIGN KEY (charac_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poll_character ADD CONSTRAINT FK_58AD99C03C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('DROP TABLE user_character');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_character DROP FOREIGN KEY FK_58AD99C03C947C0F');
        $this->addSql('CREATE TABLE user_character (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, charac_id INT NOT NULL, dead TINYINT(1) NOT NULL, white_walker TINYINT(1) NOT NULL, throne TINYINT(1) NOT NULL, INDEX IDX_939A3DD0A76ED395 (user_id), INDEX IDX_939A3DD0FF03E368 (charac_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0FF03E368 FOREIGN KEY (charac_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE poll');
        $this->addSql('DROP TABLE poll_character');
    }
}
