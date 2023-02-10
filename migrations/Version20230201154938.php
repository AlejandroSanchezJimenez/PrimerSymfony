<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201154938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participacion ADD id_usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE participacion ADD CONSTRAINT FK_669B8D697EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_669B8D697EB2C349 ON participacion (id_usuario_id)');
        $this->addSql('ALTER TABLE reserva ADD id_usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B7EB2C349 ON reserva (id_usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participacion DROP FOREIGN KEY FK_669B8D697EB2C349');
        $this->addSql('DROP INDEX IDX_669B8D697EB2C349 ON participacion');
        $this->addSql('ALTER TABLE participacion DROP id_usuario_id');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B7EB2C349');
        $this->addSql('DROP INDEX IDX_188D2E3B7EB2C349 ON reserva');
        $this->addSql('ALTER TABLE reserva DROP id_usuario_id');
    }
}
