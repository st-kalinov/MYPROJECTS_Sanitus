<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110191610 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, main_category_id INT NOT NULL, sub_category_id INT NOT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_64C19C1C6C55574 (main_category_id), INDEX IDX_64C19C1F7BFE87C (sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE main_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, info LONGTEXT DEFAULT NULL, img LONGTEXT DEFAULT NULL, slug VARCHAR(150) NOT NULL, place VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_DF6E08B4989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, main_category_id INT NOT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_BCE3F798C6C55574 (main_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1C6C55574 FOREIGN KEY (main_category_id) REFERENCES main_category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798C6C55574 FOREIGN KEY (main_category_id) REFERENCES main_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1C6C55574');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F798C6C55574');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F7BFE87C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE main_category');
        $this->addSql('DROP TABLE sub_category');
    }
}
