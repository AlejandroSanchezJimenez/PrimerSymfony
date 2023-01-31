<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127091741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, fecha_cancelacion DATE NOT NULL, presentado TINYINT(1) NOT NULL, INDEX IDX_188D2E3BDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva_tramohorario (reserva_id INT NOT NULL, tramohorario_id INT NOT NULL, INDEX IDX_DCC621E6D67139E8 (reserva_id), INDEX IDX_DCC621E65C955ECF (tramohorario_id), PRIMARY KEY(reserva_id, tramohorario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva_tramohorario ADD CONSTRAINT FK_DCC621E6D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserva_tramohorario ADD CONSTRAINT FK_DCC621E65C955ECF FOREIGN KEY (tramohorario_id) REFERENCES tramo_horario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE juego_de_mesa ADD reserva_id INT NOT NULL');
        $this->addSql('ALTER TABLE juego_de_mesa ADD CONSTRAINT FK_BE217599D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id)');
        $this->addSql('CREATE INDEX IDX_BE217599D67139E8 ON juego_de_mesa (reserva_id)');
        $this->addSql('ALTER TABLE mesa ADD reserva_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesa ADD CONSTRAINT FK_98B382F2D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id)');
        $this->addSql('CREATE INDEX IDX_98B382F2D67139E8 ON mesa (reserva_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego_de_mesa DROP FOREIGN KEY FK_BE217599D67139E8');
        $this->addSql('ALTER TABLE mesa DROP FOREIGN KEY FK_98B382F2D67139E8');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BDB38439E');
        $this->addSql('ALTER TABLE reserva_tramohorario DROP FOREIGN KEY FK_DCC621E6D67139E8');
        $this->addSql('ALTER TABLE reserva_tramohorario DROP FOREIGN KEY FK_DCC621E65C955ECF');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE reserva_tramohorario');
        $this->addSql('DROP INDEX IDX_BE217599D67139E8 ON juego_de_mesa');
        $this->addSql('ALTER TABLE juego_de_mesa DROP reserva_id');
        $this->addSql('DROP INDEX IDX_98B382F2D67139E8 ON mesa');
        $this->addSql('ALTER TABLE mesa DROP reserva_id');
    }
}
