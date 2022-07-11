<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716193220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_surveillance ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point_surveillance ADD CONSTRAINT FK_37F4543F9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_37F4543F9F2C3FAB ON point_surveillance (zone_id)');
        $this->addSql('ALTER TABLE zone ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE zone ADD CONSTRAINT FK_A0EBC007A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_A0EBC007A6E44244 ON zone (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_surveillance DROP FOREIGN KEY FK_37F4543F9F2C3FAB');
        $this->addSql('DROP INDEX IDX_37F4543F9F2C3FAB ON point_surveillance');
        $this->addSql('ALTER TABLE point_surveillance DROP zone_id');
        $this->addSql('ALTER TABLE zone DROP FOREIGN KEY FK_A0EBC007A6E44244');
        $this->addSql('DROP INDEX IDX_A0EBC007A6E44244 ON zone');
        $this->addSql('ALTER TABLE zone DROP pays_id');
    }
}
