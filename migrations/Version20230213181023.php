<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213181023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juegosde_evento (id INT AUTO_INCREMENT NOT NULL, evento_id_id INT NOT NULL, INDEX IDX_B7371B1A6F86A0CB (evento_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE juegosde_evento_juego_de_mesa (juegosde_evento_id INT NOT NULL, juego_de_mesa_id INT NOT NULL, INDEX IDX_E03B7EB2667B8DB4 (juegosde_evento_id), INDEX IDX_E03B7EB28AA2DB1C (juego_de_mesa_id), PRIMARY KEY(juegosde_evento_id, juego_de_mesa_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juegosde_evento ADD CONSTRAINT FK_B7371B1A6F86A0CB FOREIGN KEY (evento_id_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa ADD CONSTRAINT FK_E03B7EB2667B8DB4 FOREIGN KEY (juegosde_evento_id) REFERENCES juegosde_evento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa ADD CONSTRAINT FK_E03B7EB28AA2DB1C FOREIGN KEY (juego_de_mesa_id) REFERENCES juego_de_mesa (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juegosde_evento DROP FOREIGN KEY FK_B7371B1A6F86A0CB');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa DROP FOREIGN KEY FK_E03B7EB2667B8DB4');
        $this->addSql('ALTER TABLE juegosde_evento_juego_de_mesa DROP FOREIGN KEY FK_E03B7EB28AA2DB1C');
        $this->addSql('DROP TABLE juegosde_evento');
        $this->addSql('DROP TABLE juegosde_evento_juego_de_mesa');
    }
}
