<?php
class AuthController extends BaseController
{
    public function connexion(): void
    {
        $erreur = $_SESSION['erreur'] ?? null;
        unset($_SESSION['erreur']);
        require __DIR__ . '/../views/auth/connexion.php';
    }

    public function traiterConnexion(): void
    {
        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        $userModel = new User();
        $utilisateur = $userModel->trouverParEmail($email);

        if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['user_nom'] = $utilisateur['nom'];
            header('Location: index.php?route=dashboard/index');
            exit;
        }

        $_SESSION['erreur'] = "Email ou mot de passe incorrect.";
        header('Location: index.php?route=auth/connexion');
        exit;
    }

    public function inscription(): void
    {
        $erreur = $_SESSION['erreur'] ?? null;
        unset($_SESSION['erreur']);
        require __DIR__ . '/../views/auth/inscription.php';
    }

    public function traiterInscription(): void
    {
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        if ($nom === '' || $email === '' || $motDePasse === '') {
            $_SESSION['erreur'] = "Tous les champs sont obligatoires.";
            header('Location: index.php?route=auth/inscription');
            exit;
        }

        $userModel = new User();

        if ($userModel->emailExiste($email)) {
            $_SESSION['erreur'] = "Cet email est déjà utilisé.";
            header('Location: index.php?route=auth/inscription');
            exit;
        }

        $userModel->creer($nom, $email, $motDePasse);
        header('Location: index.php?route=auth/connexion');
        exit;
    }

    public function deconnexion(): void
    {
        session_destroy();
        header('Location: index.php?route=auth/connexion');
        exit;
    }
}
