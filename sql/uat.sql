CREATE DATABASE IF NOT EXISTS uat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE uat;

CREATE TABLE IF NOT EXISTS inscriptions (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nom           VARCHAR(80)  NOT NULL,
  prenom        VARCHAR(80)  NOT NULL,
  naissance     DATE         NOT NULL,
  sexe          ENUM('M','F') NOT NULL,
  adresse       VARCHAR(255) NULL,
  ville         VARCHAR(100) NULL,
  tel           VARCHAR(30)  NULL,
  email         VARCHAR(150) NOT NULL UNIQUE,
  formation     VARCHAR(100) NOT NULL,
  niveau        ENUM('L1','L2','L3','M1','M2') NOT NULL,
  langues       VARCHAR(100) NULL,
  motivation    TEXT         NULL,
  mot_de_passe  VARCHAR(255) NOT NULL,
  created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
