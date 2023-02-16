<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215214947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juegos_de_evento (id INT AUTO_INCREMENT NOT NULL, juego_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_A028725A13375255 (juego_id), INDEX IDX_A028725A87A5F842 (evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participacion (id INT AUTO_INCREMENT NOT NULL, evento_id INT NOT NULL, usuario_id INT NOT NULL, asiste TINYINT(1) DEFAULT NULL, INDEX IDX_669B8D6987A5F842 (evento_id), INDEX IDX_669B8D69DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juegos_de_evento ADD CONSTRAINT FK_A028725A13375255 FOREIGN KEY (juego_id) REFERENCES juego_de_mesa (id)');
        $this->addSql('ALTER TABLE juegos_de_evento ADD CONSTRAINT FK_A028725A87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE participacion ADD CONSTRAINT FK_669B8D6987A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE participacion ADD CONSTRAINT FK_669B8D69DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juegos_de_evento DROP FOREIGN KEY FK_A028725A13375255');
        $this->addSql('ALTER TABLE juegos_de_evento DROP FOREIGN KEY FK_A028725A87A5F842');
        $this->addSql('ALTER TABLE participacion DROP FOREIGN KEY FK_669B8D6987A5F842');
        $this->addSql('ALTER TABLE participacion DROP FOREIGN KEY FK_669B8D69DB38439E');
        $this->addSql('DROP TABLE juegos_de_evento');
        $this->addSql('DROP TABLE participacion');
    }
}
