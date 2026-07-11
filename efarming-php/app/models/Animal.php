<?php
class Animal
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getConnexion();
    }

    public function tousParUtilisateur(int $userId): array
    {
        $sql = "SELECT * FROM animals WHERE user_id = :user_id ORDER BY date_creation DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function trouverParId(int $id): array|false
    {
        $sql = "SELECT * FROM animals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function creer(array $donnees): bool
    {
        $sql = "INSERT INTO animals (user_id, identifiant, espece, race, sexe, date_naissance, statut)
                VALUES (:user_id, :identifiant, :espece, :race, :sexe, :date_naissance, :statut)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'user_id'        => $donnees['user_id'],
            'identifiant'    => $donnees['identifiant'],
            'espece'         => $donnees['espece'],
            'race'           => $donnees['race'],
            'sexe'           => $donnees['sexe'],
            'date_naissance' => $donnees['date_naissance'],
            'statut'         => $donnees['statut'] ?? 'Actif',
        ]);
    }

    public function modifier(int $id, array $donnees): bool
    {
        $sql = "UPDATE animals SET
                    identifiant = :identifiant,
                    espece = :espece,
                    race = :race,
                    sexe = :sexe,
                    date_naissance = :date_naissance,
                    statut = :statut
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'identifiant'    => $donnees['identifiant'],
            'espece'         => $donnees['espece'],
            'race'           => $donnees['race'],
            'sexe'           => $donnees['sexe'],
            'date_naissance' => $donnees['date_naissance'],
            'statut'         => $donnees['statut'],
            'id'             => $id,
        ]);
    }

    public function marquerCommeVendu(int $id): bool
    {
        $sql = "UPDATE animals SET statut = 'Vendu' WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function supprimer(int $id): bool
    {
        $sql = "DELETE FROM animals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function compterParUtilisateur(int $userId): int
    {
        $sql = "SELECT COUNT(*) FROM animals WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }
}
