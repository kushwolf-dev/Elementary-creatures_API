<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302164954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_card ADD hp VARCHAR(255) NOT NULL, ADD ability VARCHAR(255) NOT NULL, ADD weakness VARCHAR(255) NOT NULL, ADD resistance VARCHAR(255) NOT NULL, ADD type_2 VARCHAR(255) NOT NULL, ADD evolve_1 VARCHAR(255) NOT NULL, ADD evolve_2 VARCHAR(255) NOT NULL, ADD background_image VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_card DROP hp, DROP ability, DROP weakness, DROP resistance, DROP type_2, DROP evolve_1, DROP evolve_2, DROP background_image');
    }
}
