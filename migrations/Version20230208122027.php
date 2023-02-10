<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208122027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva_tramo_horario (reserva_id INT NOT NULL, tramo_horario_id INT NOT NULL, INDEX IDX_909899B3D67139E8 (reserva_id), INDEX IDX_909899B3A6848DE (tramo_horario_id), PRIMARY KEY(reserva_id, tramo_horario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva_tramo_horario ADD CONSTRAINT FK_909899B3D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserva_tramo_horario ADD CONSTRAINT FK_909899B3A6848DE FOREIGN KEY (tramo_horario_id) REFERENCES tramo_horario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserva_tramohorario DROP FOREIGN KEY FK_DCC621E65C955ECF');
        $this->addSql('ALTER TABLE reserva_tramohorario DROP FOREIGN KEY FK_DCC621E6D67139E8');
        $this->addSql('DROP TABLE reserva_tramohorario');
        $this->addSql('ALTER TABLE juego_de_mesa ADD tablero LONGBLOB NOT NULL, CHANGE carátula caratula LONGBLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reserva_tramohorario (reserva_id INT NOT NULL, tramohorario_id INT NOT NULL, INDEX IDX_DCC621E65C955ECF (tramohorario_id), INDEX IDX_DCC621E6D67139E8 (reserva_id), PRIMARY KEY(reserva_id, tramohorario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reserva_tramohorario ADD CONSTRAINT FK_DCC621E65C955ECF FOREIGN KEY (tramohorario_id) REFERENCES tramo_horario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserva_tramohorario ADD CONSTRAINT FK_DCC621E6D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reserva_tramo_horario DROP FOREIGN KEY FK_909899B3D67139E8');
        $this->addSql('ALTER TABLE reserva_tramo_horario DROP FOREIGN KEY FK_909899B3A6848DE');
        $this->addSql('DROP TABLE reserva_tramo_horario');
        $this->addSql('ALTER TABLE juego_de_mesa ADD carátula LONGBLOB NOT NULL, DROP caratula, DROP tablero');
    }
}
