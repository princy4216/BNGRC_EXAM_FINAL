-- Création de la base de données
CREATE DATABASE IF NOT EXISTS bngrc_dons;
USE bngrc_dons;

-- 1. Table Ville
CREATE TABLE IF NOT EXISTS ville (
    id_ville INT PRIMARY KEY AUTO_INCREMENT,
    nom_ville VARCHAR(100) NOT NULL,
    nom_region VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table Besoins
CREATE TABLE IF NOT EXISTS besoins (
    id_besoin INT PRIMARY KEY AUTO_INCREMENT,
    id_ville INT NOT NULL,
    nom_article VARCHAR(150) NOT NULL,
    type ENUM('nourriture', 'materiel', 'argent') NOT NULL,
    quantite_besoin DECIMAL(10,2) NOT NULL,
    unite VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ville) REFERENCES ville(id_ville) ON DELETE CASCADE
);

-- 3. Table Dons
CREATE TABLE IF NOT EXISTS dons (
    id_don INT PRIMARY KEY AUTO_INCREMENT,
    id_besoin INT NOT NULL,
    quantite_don DECIMAL(10,2) NOT NULL,
    date_don DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_besoin) REFERENCES besoins(id_besoin) ON DELETE CASCADE
);

-- Insertion de données exemple pour tester
INSERT INTO ville (nom_ville, nom_region) VALUES
('Antananarivo', 'Analamanga'),
('Toamasina', 'Atsinanana'),
('Fianarantsoa', 'Haute Matsiatra'),
('Mahajanga', 'Boeny'),
('Toliara', 'Atsimo Andrefana');

-- Insertion de besoins exemple
INSERT INTO besoins (id_ville, nom_article, type, quantite_besoin, unite) VALUES
(1, 'Riz', 'nourriture', 500, 'kg'),
(1, 'Huile', 'nourriture', 200, 'litre'),
(2, 'Tôles', 'materiel', 100, 'pieces'),
(2, 'Clous', 'materiel', 50, 'kg'),
(3, 'Argent secours', 'argent', 1000000, 'Ar'),
(4, 'Eau', 'nourriture', 1000, 'litre'),
(5, 'Tentes', 'materiel', 50, 'pieces');

-- Insertion de dons exemple
INSERT INTO dons (id_besoin, quantite_don, date_don) VALUES
(1, 200, '2026-02-15'),
(1, 150, '2026-02-16'),
(2, 50, '2026-02-16'),
(3, 30, '2026-02-15'),
(5, 500000, '2026-02-16');