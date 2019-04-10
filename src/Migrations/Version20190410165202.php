<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410165202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `character` ADD image VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX uniq_957a647992fc23a8 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64992FC23A8 ON user (username_canonical)');
        $this->addSql('DROP INDEX uniq_957a6479a0d96fbf ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0D96FBF ON user (email_canonical)');
        $this->addSql('DROP INDEX uniq_957a6479c05fb297 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C05FB297 ON user (confirmation_token)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `character` DROP image, DROP updated_at');
        $this->addSql('DROP INDEX uniq_8d93d649a0d96fbf ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON user (email_canonical)');
        $this->addSql('DROP INDEX uniq_8d93d649c05fb297 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON user (confirmation_token)');
        $this->addSql('DROP INDEX uniq_8d93d64992fc23a8 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON user (username_canonical)');
    }
}
