<?php
class BaseController
{
    
    protected function verifierConnexion(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=auth/connexion');
            exit;
        }
    }

    protected function getUserId(): int
    {
        return (int) ($_SESSION['user_id'] ?? 0);
    }

    protected function render(string $vue, array $donnees = []): void
    {
        extract($donnees);
        require __DIR__ . '/../views/layout.php';
    }
}
