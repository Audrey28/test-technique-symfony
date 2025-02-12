<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212200900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, specialist_id INTEGER NOT NULL, date DATETIME DEFAULT NULL, CONSTRAINT FK_130D3BD7B100C1A FOREIGN KEY (specialist_id) REFERENCES specialist (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_130D3BD7B100C1A ON appel (specialist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appel');
    }
}
