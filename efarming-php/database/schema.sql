CREATE DATABASE IF NOT EXISTS e_farming CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE e_farming;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE animals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    identifiant VARCHAR(50) UNIQUE NOT NULL,   -- ex: tag/boucle de l'animal
    espece VARCHAR(50) NOT NULL,               -- ex: bovin, ovin, caprin, volaille
    race VARCHAR(100),
    sexe ENUM('Male', 'Femelle') NOT NULL,
    date_naissance DATE,
    statut ENUM('Actif', 'Vendu', 'Décédé') NOT NULL DEFAULT 'Actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE health_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    type ENUM('Vaccination', 'Traitement', 'Maladie') NOT NULL,
    description TEXT,
    date_evenement DATE NOT NULL,
    date_rappel DATE,                          -- prochaine date de rappel (vaccin)
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (animal_id) REFERENCES animals(id) ON DELETE CASCADE
);

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    acheteur VARCHAR(150) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    date_vente DATE NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (animal_id) REFERENCES animals(id) ON DELETE CASCADE
);

CREATE INDEX idx_animals_user ON animals(user_id);
CREATE INDEX idx_health_animal ON health_records(animal_id);
CREATE INDEX idx_sales_animal ON sales(animal_id);
