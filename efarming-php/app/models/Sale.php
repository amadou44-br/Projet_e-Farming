<?php
class Sale
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getConnexion();
    }

    public function tousParUtilisateur(int $userId): array
    {
        $sql = "SELECT s.*, a.identifiant AS animal_identifiant
                FROM sales s
                JOIN animals a ON s.animal_id = a.id
                WHERE a.user_id = :user_id
                ORDER BY s.date_vente DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function creer(array $donnees): bool
    {
        $sql = "INSERT INTO sales (animal_id, acheteur, prix, date_vente)
                VALUES (:animal_id, :acheteur, :prix, :date_vente)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'animal_id'  => $donnees['animal_id'],
            'acheteur'   => $donnees['acheteur'],
            'prix'       => $donnees['prix'],
            'date_vente' => $donnees['date_vente'],
        ]);
    }

    public function totalVentes(int $userId): float
    {
        $sql = "SELECT COALESCE(SUM(s.prix), 0)
                FROM sales s
                JOIN animals a ON s.animal_id = a.id
                WHERE a.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return (float) $stmt->fetchColumn();
    }

    public function compterParUtilisateur(int $userId): int
    {
        $sql = "SELECT COUNT(*)
                FROM sales s
                JOIN animals a ON s.animal_id = a.id
                WHERE a.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }
}
