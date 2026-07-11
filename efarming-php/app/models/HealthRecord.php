<?php
class HealthRecord
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getConnexion();
    }

    public function tousParAnimal(int $animalId): array
    {
        $sql = "SELECT * FROM health_records WHERE animal_id = :animal_id ORDER BY date_evenement DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['animal_id' => $animalId]);
        return $stmt->fetchAll();
    }

    public function tousParUtilisateur(int $userId): array
    {
        $sql = "SELECT h.*, a.identifiant AS animal_identifiant
                FROM health_records h
                JOIN animals a ON h.animal_id = a.id
                WHERE a.user_id = :user_id
                ORDER BY h.date_evenement DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function rappelsAVenir(int $userId): array
    {
        $sql = "SELECT h.*, a.identifiant AS animal_identifiant
                FROM health_records h
                JOIN animals a ON h.animal_id = a.id
                WHERE a.user_id = :user_id
                  AND h.date_rappel IS NOT NULL
                  AND h.date_rappel >= CURDATE()
                ORDER BY h.date_rappel ASC
                LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function creer(array $donnees): bool
    {
        $sql = "INSERT INTO health_records (animal_id, type, description, date_evenement, date_rappel)
                VALUES (:animal_id, :type, :description, :date_evenement, :date_rappel)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'animal_id'      => $donnees['animal_id'],
            'type'           => $donnees['type'],
            'description'    => $donnees['description'],
            'date_evenement' => $donnees['date_evenement'],
            'date_rappel'    => $donnees['date_rappel'] ?: null,
        ]);
    }

    public function supprimer(int $id): bool
    {
        $sql = "DELETE FROM health_records WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
