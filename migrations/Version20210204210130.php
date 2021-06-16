<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204210130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE constat ADD nom_conducteur_voiture_a VARCHAR(255) NOT NULL, ADD prenom_conducteur_voiture_a VARCHAR(255) NOT NULL, ADD datedenaissanceconducteur_a DATE NOT NULL, ADD nom_conducteur_voiture_b VARCHAR(255) NOT NULL, ADD prenom_conducteur_voiture_b VARCHAR(255) NOT NULL, ADD datedenaissanceconducteur_b DATE NOT NULL, DROP point_choc, DROP nom_conducteur, DROP prenom_conducteur');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE constat ADD point_choc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom_conducteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom_conducteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom_conducteur_voiture_a, DROP prenom_conducteur_voiture_a, DROP datedenaissanceconducteur_a, DROP nom_conducteur_voiture_b, DROP prenom_conducteur_voiture_b, DROP datedenaissanceconducteur_b');
    }
}
