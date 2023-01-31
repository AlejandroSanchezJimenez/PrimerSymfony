<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127093829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juegosde_evento (id INT AUTO_INCREMENT NOT NULL, juego_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_B7371B1A13375255 (juego_id), INDEX IDX_B7371B1A87A5F842 (evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juegosde_evento ADD CONSTRAINT FK_B7371B1A13375255 FOREIGN KEY (juego_id) REFERENCES juego_de_mesa (id)');
        $this->addSql('ALTER TABLE juegosde_evento ADD CONSTRAINT FK_B7371B1A87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juegosde_evento DROP FOREIGN KEY FK_B7371B1A13375255');
        $this->addSql('ALTER TABLE juegosde_evento DROP FOREIGN KEY FK_B7371B1A87A5F842');
        $this->addSql('DROP TABLE juegosde_evento');
    }
}
