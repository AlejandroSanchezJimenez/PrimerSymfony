<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201154210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participacion DROP FOREIGN KEY FK_669B8D69DB38439E');
        $this->addSql('DROP INDEX IDX_669B8D69DB38439E ON participacion');
        $this->addSql('ALTER TABLE participacion DROP usuario_id');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDB38439E');
        $this->addSql('DROP INDEX IDX_188D2E3BDB38439E ON reserva');
        $this->addSql('ALTER TABLE reserva DROP usuario_id');
        $this->addSql('ALTER TABLE usuario ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP nombre, DROP ape1, DROP ape2, DROP contraseña, DROP correo_electronico, DROP nickname, DROP rol, DROP num_telegram');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participacion ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE participacion ADD CONSTRAINT FK_669B8D69DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_669B8D69DB38439E ON participacion (usuario_id)');
        $this->addSql('ALTER TABLE reserva ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3BDB38439E ON reserva (usuario_id)');
        $this->addSql('DROP INDEX UNIQ_2265B05DE7927C74 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD nombre VARCHAR(30) NOT NULL, ADD ape1 VARCHAR(40) NOT NULL, ADD ape2 VARCHAR(40) DEFAULT NULL, ADD contraseña VARCHAR(10) NOT NULL, ADD correo_electronico VARCHAR(30) NOT NULL, ADD nickname VARCHAR(15) NOT NULL, ADD rol VARCHAR(20) NOT NULL, ADD num_telegram INT NOT NULL, DROP email, DROP roles, DROP password');
    }
}
