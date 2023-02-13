<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213181557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa DROP FOREIGN KEY FK_E03B7EB2667B8DB4');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa DROP FOREIGN KEY FK_E03B7EB28AA2DB1C');
        $this->addSql('DROP TABLE juegosde_evento_juego_de_mesa');
        $this->addSql('ALTER TABLE juegosde_evento ADD juego_id INT NOT NULL');
        $this->addSql('ALTER TABLE juegosde_evento ADD CONSTRAINT FK_B7371B1A13375255 FOREIGN KEY (juego_id) REFERENCES juego_de_mesa (id)');
        $this->addSql('CREATE INDEX IDX_B7371B1A13375255 ON juegosde_evento (juego_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juegosde_evento_juego_de_mesa (juegosde_evento_id INT NOT NULL, juego_de_mesa_id INT NOT NULL, INDEX IDX_E03B7EB28AA2DB1C (juego_de_mesa_id), INDEX IDX_E03B7EB2667B8DB4 (juegosde_evento_id), PRIMARY KEY(juegosde_evento_id, juego_de_mesa_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa ADD CONSTRAINT FK_E03B7EB2667B8DB4 FOREIGN KEY (juegosde_evento_id) REFERENCES juegosde_evento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa ADD CONSTRAINT FK_E03B7EB28AA2DB1C FOREIGN KEY (juego_de_mesa_id) REFERENCES juego_de_mesa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE juegosde_evento DROP FOREIGN KEY FK_B7371B1A13375255');
        $this->addSql('DROP INDEX IDX_B7371B1A13375255 ON juegosde_evento');
        $this->addSql('ALTER TABLE juegosde_evento DROP juego_id');
    }
}
