<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720145918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel ADD hotel_owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED93C5DB38B FOREIGN KEY (hotel_owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3535ED93C5DB38B ON hotel (hotel_owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED93C5DB38B');
        $this->addSql('DROP INDEX IDX_3535ED93C5DB38B ON hotel');
        $this->addSql('ALTER TABLE hotel DROP hotel_owner_id');
    }
}
