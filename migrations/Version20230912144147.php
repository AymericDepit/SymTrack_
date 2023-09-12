<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912144147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classements (id INT AUTO_INCREMENT NOT NULL, jeu_id INT DEFAULT NULL, INDEX IDX_28583C738C9E392E (jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classements_utilisateurs (classements_id INT NOT NULL, utilisateurs_id INT NOT NULL, INDEX IDX_9BCA477D26B5B328 (classements_id), INDEX IDX_9BCA477D1E969C5 (utilisateurs_id), PRIMARY KEY(classements_id, utilisateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classements_circuits (classements_id INT NOT NULL, circuits_id INT NOT NULL, INDEX IDX_EAE130EC26B5B328 (classements_id), INDEX IDX_EAE130EC7201D625 (circuits_id), PRIMARY KEY(classements_id, circuits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classements_voitures (classements_id INT NOT NULL, voitures_id INT NOT NULL, INDEX IDX_4511ECD226B5B328 (classements_id), INDEX IDX_4511ECD2CCC4661F (voitures_id), PRIMARY KEY(classements_id, voitures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, creneau_id INT NOT NULL, jeux_id INT NOT NULL, circuits_id INT NOT NULL, voitures_id INT NOT NULL, classements_id INT DEFAULT NULL, temps INT NOT NULL, UNIQUE INDEX UNIQ_9A609D137D0729A9 (creneau_id), INDEX IDX_9A609D13EC2AA9D2 (jeux_id), INDEX IDX_9A609D137201D625 (circuits_id), INDEX IDX_9A609D13CCC4661F (voitures_id), INDEX IDX_9A609D1326B5B328 (classements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classements ADD CONSTRAINT FK_28583C738C9E392E FOREIGN KEY (jeu_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE classements_utilisateurs ADD CONSTRAINT FK_9BCA477D26B5B328 FOREIGN KEY (classements_id) REFERENCES classements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classements_utilisateurs ADD CONSTRAINT FK_9BCA477D1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classements_circuits ADD CONSTRAINT FK_EAE130EC26B5B328 FOREIGN KEY (classements_id) REFERENCES classements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classements_circuits ADD CONSTRAINT FK_EAE130EC7201D625 FOREIGN KEY (circuits_id) REFERENCES circuits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classements_voitures ADD CONSTRAINT FK_4511ECD226B5B328 FOREIGN KEY (classements_id) REFERENCES classements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classements_voitures ADD CONSTRAINT FK_4511ECD2CCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D137D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneaux (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D137201D625 FOREIGN KEY (circuits_id) REFERENCES circuits (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13CCC4661F FOREIGN KEY (voitures_id) REFERENCES voitures (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D1326B5B328 FOREIGN KEY (classements_id) REFERENCES classements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classements DROP FOREIGN KEY FK_28583C738C9E392E');
        $this->addSql('ALTER TABLE classements_utilisateurs DROP FOREIGN KEY FK_9BCA477D26B5B328');
        $this->addSql('ALTER TABLE classements_utilisateurs DROP FOREIGN KEY FK_9BCA477D1E969C5');
        $this->addSql('ALTER TABLE classements_circuits DROP FOREIGN KEY FK_EAE130EC26B5B328');
        $this->addSql('ALTER TABLE classements_circuits DROP FOREIGN KEY FK_EAE130EC7201D625');
        $this->addSql('ALTER TABLE classements_voitures DROP FOREIGN KEY FK_4511ECD226B5B328');
        $this->addSql('ALTER TABLE classements_voitures DROP FOREIGN KEY FK_4511ECD2CCC4661F');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D137D0729A9');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D13EC2AA9D2');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D137201D625');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D13CCC4661F');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D1326B5B328');
        $this->addSql('DROP TABLE classements');
        $this->addSql('DROP TABLE classements_utilisateurs');
        $this->addSql('DROP TABLE classements_circuits');
        $this->addSql('DROP TABLE classements_voitures');
        $this->addSql('DROP TABLE sessions');
    }
}
