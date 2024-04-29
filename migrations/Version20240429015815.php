<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429015815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ec (id INT AUTO_INCREMENT NOT NULL, ue_id INT NOT NULL, code_ec VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, descrption LONGTEXT DEFAULT NULL, credit INT NOT NULL, INDEX IDX_8DE8BDFF62E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(55) NOT NULL, descrption VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, level_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, ec_id INT DEFAULT NULL, note_cc DOUBLE PRECISION NOT NULL, note_sn DOUBLE PRECISION NOT NULL, note_tp DOUBLE PRECISION DEFAULT NULL, note_rattrapge DOUBLE PRECISION DEFAULT NULL, INDEX IDX_11BA68CCB944F1A (student_id), INDEX IDX_11BA68C27634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prefessor (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, field_id INT NOT NULL, level_id INT NOT NULL, student_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, date_of_birth DATE NOT NULL, place_of_birth LONGTEXT NOT NULL, birth_certificate LONGTEXT DEFAULT NULL, admission_certificate LONGTEXT DEFAULT NULL, INDEX IDX_B723AF33443707B0 (field_id), INDEX IDX_B723AF335FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE take_ue (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, ue_id INT NOT NULL, level_id INT DEFAULT NULL, grade VARCHAR(5) DEFAULT NULL, semester INT NOT NULL, academic_year VARCHAR(255) NOT NULL, INDEX IDX_AC89C73DCB944F1A (student_id), INDEX IDX_AC89C73D62E883B1 (ue_id), INDEX IDX_AC89C73D5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teach (id INT AUTO_INCREMENT NOT NULL, professor_id INT NOT NULL, ec_id INT NOT NULL, teach_date DATE NOT NULL, duration VARCHAR(255) NOT NULL, INDEX IDX_8224C63A7D2D84D5 (professor_id), INDEX IDX_8224C63A27634BEF (ec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, level_id INT DEFAULT NULL, code_ue VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, credit INT NOT NULL, semester VARCHAR(255) NOT NULL, INDEX IDX_2E490A9B5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_field (ue_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_38132BB862E883B1 (ue_id), INDEX IDX_38132BB8443707B0 (field_id), PRIMARY KEY(ue_id, field_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ec ADD CONSTRAINT FK_8DE8BDFF62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73D62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE take_ue ADD CONSTRAINT FK_AC89C73D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A7D2D84D5 FOREIGN KEY (professor_id) REFERENCES prefessor (id)');
        $this->addSql('ALTER TABLE teach ADD CONSTRAINT FK_8224C63A27634BEF FOREIGN KEY (ec_id) REFERENCES ec (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_field ADD CONSTRAINT FK_38132BB8443707B0 FOREIGN KEY (field_id) REFERENCES field (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ec DROP FOREIGN KEY FK_8DE8BDFF62E883B1');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CCB944F1A');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C27634BEF');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33443707B0');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335FB14BA7');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73DCB944F1A');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73D62E883B1');
        $this->addSql('ALTER TABLE take_ue DROP FOREIGN KEY FK_AC89C73D5FB14BA7');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A7D2D84D5');
        $this->addSql('ALTER TABLE teach DROP FOREIGN KEY FK_8224C63A27634BEF');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B5FB14BA7');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB862E883B1');
        $this->addSql('ALTER TABLE ue_field DROP FOREIGN KEY FK_38132BB8443707B0');
        $this->addSql('DROP TABLE ec');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE prefessor');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE take_ue');
        $this->addSql('DROP TABLE teach');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE ue_field');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
