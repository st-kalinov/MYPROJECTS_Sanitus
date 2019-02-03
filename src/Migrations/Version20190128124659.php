<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190128124659 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE main_category_brand (main_category_id INT NOT NULL, brand_id INT NOT NULL, INDEX IDX_7A6DFD5BC6C55574 (main_category_id), INDEX IDX_7A6DFD5B44F5D008 (brand_id), PRIMARY KEY(main_category_id, brand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE main_category_brand ADD CONSTRAINT FK_7A6DFD5BC6C55574 FOREIGN KEY (main_category_id) REFERENCES main_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE main_category_brand ADD CONSTRAINT FK_7A6DFD5B44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE main_category_brand');
    }
}
