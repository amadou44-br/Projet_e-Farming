<?php
class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = getConnexion();
    }

    public function creer(string $nom, string $email, string $motDePasse): bool
    {
        $hash = password_hash($motDePasse, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (nom, email, mot_de_passe) VALUES (:nom, :email, :mdp)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom'   => $nom,
            'email' => $email,
            'mdp'   => $hash,
        ]);
    }

    public function trouverParEmail(string $email): array|false
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function emailExiste(string $email): bool
    {
        return $this->trouverParEmail($email) !== false;
    }
}
