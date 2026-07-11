<?php
class HealthController extends BaseController
{
    public function liste(): void
    {
        $this->verifierConnexion();
        $healthModel = new HealthRecord();
        $soins = $healthModel->tousParUtilisateur($this->getUserId());
        $this->render('health/liste_soins', ['soins' => $soins]);
    }

    public function ajouter(): void
    {
        $this->verifierConnexion();
        $animalModel = new Animal();
        $animaux = $animalModel->tousParUtilisateur($this->getUserId());
        $this->render('health/ajouter_soin', ['animaux' => $animaux]);
    }

    public function traiterAjout(): void
    {
        $this->verifierConnexion();

        $donnees = [
            'animal_id'      => (int) ($_POST['animal_id'] ?? 0),
            'type'           => $_POST['type'] ?? '',
            'description'    => trim($_POST['description'] ?? ''),
            'date_evenement' => $_POST['date_evenement'] ?? null,
            'date_rappel'    => $_POST['date_rappel'] ?? null,
        ];

        $healthModel = new HealthRecord();
        $healthModel->creer($donnees);

        header('Location: index.php?route=health/liste');
        exit;
    }

    public function supprimer(): void
    {
        $this->verifierConnexion();
        $id = (int) ($_GET['id'] ?? 0);

        $healthModel = new HealthRecord();
        $healthModel->supprimer($id);

        header('Location: index.php?route=health/liste');
        exit;
    }
}
