<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419122018 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_theme DROP FOREIGN KEY FK_6E6BE74B89032C');
        $this->addSql('ALTER TABLE post_theme DROP FOREIGN KEY FK_6E6BE759027487');
        $this->addSql('ALTER TABLE post_theme ADD CONSTRAINT FK_6E6BE74B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_theme ADD CONSTRAINT FK_6E6BE759027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708A76ED395');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE channel DROP FOREIGN KEY FK_A2F98E47A76ED395');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E47A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE channel DROP FOREIGN KEY FK_A2F98E47A76ED395');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E47A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post_theme DROP FOREIGN KEY FK_6E6BE74B89032C');
        $this->addSql('ALTER TABLE post_theme DROP FOREIGN KEY FK_6E6BE759027487');
        $this->addSql('ALTER TABLE post_theme ADD CONSTRAINT FK_6E6BE74B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_theme ADD CONSTRAINT FK_6E6BE759027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708A76ED395');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
