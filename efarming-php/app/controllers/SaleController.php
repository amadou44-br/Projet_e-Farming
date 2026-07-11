<?php
class SaleController extends BaseController
{
    public function liste(): void
    {
        $this->verifierConnexion();
        $saleModel = new Sale();
        $ventes = $saleModel->tousParUtilisateur($this->getUserId());
        $this->render('sales/liste_ventes', ['ventes' => $ventes]);
    }

    public function ajouter(): void
    {
        $this->verifierConnexion();
        $animalModel = new Animal();
        $tousAnimaux = $animalModel->tousParUtilisateur($this->getUserId());
        $animaux = array_filter($tousAnimaux, fn($a) => $a['statut'] === 'Actif');

        $this->render('sales/ajouter_vente', ['animaux' => $animaux]);
    }

    public function traiterAjout(): void
    {
        $this->verifierConnexion();

        $animalId = (int) ($_POST['animal_id'] ?? 0);

        $donnees = [
            'animal_id'  => $animalId,
            'acheteur'   => trim($_POST['acheteur'] ?? ''),
            'prix'       => (float) ($_POST['prix'] ?? 0),
            'date_vente' => $_POST['date_vente'] ?? null,
        ];

        $saleModel = new Sale();
        $saleModel->creer($donnees);

        $animalModel = new Animal();
        $animalModel->marquerCommeVendu($animalId);

        header('Location: index.php?route=sales/liste');
        exit;
    }
}
