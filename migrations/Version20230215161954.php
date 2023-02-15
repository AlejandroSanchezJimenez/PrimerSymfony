<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215161954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento DROP FOREIGN KEY FK_47860B052FD6DD78');
        $this->addSql('DROP INDEX IDX_47860B052FD6DD78 ON evento');
        $this->addSql('ALTER TABLE evento ADD fecha_evento DATE NOT NULL, DROP juegos_de_evento_id, DROP fecha_ini, DROP fecha_fin');
        $this->addSql('ALTER TABLE juegos_de_evento ADD evento_id INT NOT NULL');
        $this->addSql('ALTER TABLE juegos_de_evento ADD CONSTRAINT FK_A028725A87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('CREATE INDEX IDX_A028725A87A5F842 ON juegos_de_evento (evento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento ADD juegos_de_evento_id INT NOT NULL, ADD fecha_fin DATE NOT NULL, CHANGE fecha_evento fecha_ini DATE NOT NULL');
        $this->addSql('ALTER TABLE evento ADD CONSTRAINT FK_47860B052FD6DD78 FOREIGN KEY (juegos_de_evento_id) REFERENCES juegos_de_evento (id)');
        $this->addSql('CREATE INDEX IDX_47860B052FD6DD78 ON evento (juegos_de_evento_id)');
        $this->addSql('ALTER TABLE juegos_de_evento DROP FOREIGN KEY FK_A028725A87A5F842');
        $this->addSql('DROP INDEX IDX_A028725A87A5F842 ON juegos_de_evento');
        $this->addSql('ALTER TABLE juegos_de_evento DROP evento_id');
    }
}
