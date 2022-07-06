<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704215046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE attraction ADD CONSTRAINT FK_D503E6B8E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE attraction ADD CONSTRAINT FK_D503E6B8BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D503E6B8E104C1D3 ON attraction (created_user_id)');
        $this->addSql('CREATE INDEX IDX_D503E6B8BB649746 ON attraction (updated_user_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7876C4DDA');
        $this->addSql('DROP INDEX IDX_3BAE0AA7876C4DDA ON event');
        $this->addSql('ALTER TABLE event ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD organizer VARCHAR(255) DEFAULT NULL, ADD start_date DATETIME DEFAULT NULL, ADD end_date DATETIME DEFAULT NULL, DROP organizer_id, DROP start_datetime, DROP end_datetime');
        $this->addSql('ALTER TABLE hotel ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9E104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9BB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3535ED9E104C1D3 ON hotel (created_user_id)');
        $this->addSql('CREATE INDEX IDX_3535ED9BB649746 ON hotel (updated_user_id)');
        $this->addSql('ALTER TABLE location ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE longitude longitude VARCHAR(255) DEFAULT NULL, CHANGE latitude latitude VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FE104C1D3 ON message (created_user_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FBB649746 ON message (updated_user_id)');
        $this->addSql('ALTER TABLE room ADD created_user_id INT DEFAULT NULL, ADD updated_user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BBB649746 FOREIGN KEY (updated_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_729F519BE104C1D3 ON room (created_user_id)');
        $this->addSql('CREATE INDEX IDX_729F519BBB649746 ON room (updated_user_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction DROP FOREIGN KEY FK_D503E6B8E104C1D3');
        $this->addSql('ALTER TABLE attraction DROP FOREIGN KEY FK_D503E6B8BB649746');
        $this->addSql('DROP INDEX IDX_D503E6B8E104C1D3 ON attraction');
        $this->addSql('DROP INDEX IDX_D503E6B8BB649746 ON attraction');
        $this->addSql('ALTER TABLE attraction DROP created_user_id, DROP updated_user_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE event ADD organizer_id INT NOT NULL, ADD start_datetime DATETIME DEFAULT NULL, ADD end_datetime DATETIME DEFAULT NULL, DROP created_at, DROP updated_at, DROP organizer, DROP start_date, DROP end_date');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7876C4DDA FOREIGN KEY (organizer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7876C4DDA ON event (organizer_id)');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9E104C1D3');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9BB649746');
        $this->addSql('DROP INDEX IDX_3535ED9E104C1D3 ON hotel');
        $this->addSql('DROP INDEX IDX_3535ED9BB649746 ON hotel');
        $this->addSql('ALTER TABLE hotel DROP created_user_id, DROP updated_user_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE location DROP created_at, DROP updated_at, CHANGE longitude longitude VARCHAR(255) NOT NULL, CHANGE latitude latitude VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE104C1D3');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FBB649746');
        $this->addSql('DROP INDEX IDX_B6BD307FE104C1D3 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FBB649746 ON message');
        $this->addSql('ALTER TABLE message DROP created_user_id, DROP updated_user_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BE104C1D3');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BBB649746');
        $this->addSql('DROP INDEX IDX_729F519BE104C1D3 ON room');
        $this->addSql('DROP INDEX IDX_729F519BBB649746 ON room');
        $this->addSql('ALTER TABLE room DROP created_user_id, DROP updated_user_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user DROP created_at, DROP updated_at');
    }
}
