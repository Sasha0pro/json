<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228103753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE token CHANGE access_token_expired_at access_token_expired_at VARCHAR(255) NOT NULL, CHANGE refresh_token_expired_at refresh_token_expired_at VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE token CHANGE access_token_expired_at access_token_expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE refresh_token_expired_at refresh_token_expired_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
