<?php
class AnimalController extends BaseController
{
    public function liste(): void
    {
        $this->verifierConnexion();
        $animalModel = new Animal();
        $animaux = $animalModel->tousParUtilisateur($this->getUserId());
        $this->render('animals/liste_animaux', ['animaux' => $animaux]);
    }

    public function ajouter(): void
    {
        $this->verifierConnexion();
        $this->render('animals/ajouter_animal');
    }

    public function traiterAjout(): void
    {
        $this->verifierConnexion();

        $donnees = [
            'user_id'        => $this->getUserId(),
            'identifiant'    => trim($_POST['identifiant'] ?? ''),
            'espece'         => trim($_POST['espece'] ?? ''),
            'race'           => trim($_POST['race'] ?? ''),
            'sexe'           => $_POST['sexe'] ?? '',
            'date_naissance' => $_POST['date_naissance'] ?: null,
            'statut'         => 'Actif',
        ];

        $animalModel = new Animal();
        $animalModel->creer($donnees);

        header('Location: index.php?route=animals/liste');
        exit;
    }

    public function details(): void
    {
        $this->verifierConnexion();
        $id = (int) ($_GET['id'] ?? 0);

        $animalModel = new Animal();
        $healthModel = new HealthRecord();

        $animal = $animalModel->trouverParId($id);
        if (!$animal || $animal['user_id'] != $this->getUserId()) {
            header('Location: index.php?route=animals/liste');
            exit;
        }

        $historiqueSante = $healthModel->tousParAnimal($id);

        $this->render('animals/details_animal', [
            'animal' => $animal,
            'historiqueSante' => $historiqueSante,
        ]);
    }

    public function modifier(): void
    {
        $this->verifierConnexion();
        $id = (int) ($_GET['id'] ?? 0);

        $animalModel = new Animal();
        $animal = $animalModel->trouverParId($id);

        if (!$animal || $animal['user_id'] != $this->getUserId()) {
            header('Location: index.php?route=animals/liste');
            exit;
        }

        $this->render('animals/modifier_animal', ['animal' => $animal]);
    }

    public function traiterModification(): void
    {
        $this->verifierConnexion();
        $id = (int) ($_POST['id'] ?? 0);

        $donnees = [
            'identifiant'    => trim($_POST['identifiant'] ?? ''),
            'espece'         => trim($_POST['espece'] ?? ''),
            'race'           => trim($_POST['race'] ?? ''),
            'sexe'           => $_POST['sexe'] ?? '',
            'date_naissance' => $_POST['date_naissance'] ?: null,
            'statut'         => $_POST['statut'] ?? 'Actif',
        ];

        $animalModel = new Animal();
        $animalModel->modifier($id, $donnees);

        header('Location: index.php?route=animals/details&id=' . $id);
        exit;
    }

    public function supprimer(): void
    {
        $this->verifierConnexion();
        $id = (int) ($_GET['id'] ?? 0);

        $animalModel = new Animal();
        $animalModel->supprimer($id);

        header('Location: index.php?route=animals/liste');
        exit;
    }
}
