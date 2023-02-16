<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215180334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evento_juego_de_mesa (evento_id INT NOT NULL, juego_de_mesa_id INT NOT NULL, INDEX IDX_292221587A5F842 (evento_id), INDEX IDX_29222158AA2DB1C (juego_de_mesa_id), PRIMARY KEY(evento_id, juego_de_mesa_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evento_usuario (evento_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_3EF0782287A5F842 (evento_id), INDEX IDX_3EF07822DB38439E (usuario_id), PRIMARY KEY(evento_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evento_juego_de_mesa ADD CONSTRAINT FK_292221587A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evento_juego_de_mesa ADD CONSTRAINT FK_29222158AA2DB1C FOREIGN KEY (juego_de_mesa_id) REFERENCES juego_de_mesa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evento_usuario ADD CONSTRAINT FK_3EF0782287A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evento_usuario ADD CONSTRAINT FK_3EF07822DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento_juego_de_mesa DROP FOREIGN KEY FK_292221587A5F842');
        $this->addSql('ALTER TABLE evento_juego_de_mesa DROP FOREIGN KEY FK_29222158AA2DB1C');
        $this->addSql('ALTER TABLE evento_usuario DROP FOREIGN KEY FK_3EF0782287A5F842');
        $this->addSql('ALTER TABLE evento_usuario DROP FOREIGN KEY FK_3EF07822DB38439E');
        $this->addSql('DROP TABLE evento_juego_de_mesa');
        $this->addSql('DROP TABLE evento_usuario');
    }
}
