<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125064351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `user` (
                id INT NOT NULL AUTO_INCREMENT, 
                telegram_first_name VARCHAR(255) NOT NULL,
                telegram_last_name VARCHAR(255) NULL,
                telegram_username VARCHAR(255) NULL,
                telegram_id BIGINT NOT NULL,
                is_bot BOOLEAN NOT NULL default false,
                is_admin BOOLEAN NOT NULL default false,
                name VARCHAR(255) NULL,
                phone VARCHAR(255) NULL,
                created_at TIMESTAMP NOT NULL,
                updated_at TIMESTAMP NOT NULL,
                PRIMARY KEY(id)
            )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `user`');
    }
}
