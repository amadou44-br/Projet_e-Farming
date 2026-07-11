<?php
class DashboardController extends BaseController
{
    public function index(): void
    {
        $this->verifierConnexion();
        $userId = $this->getUserId();

        $animalModel = new Animal();
        $saleModel = new Sale();
        $healthModel = new HealthRecord();

        $donnees = [
            'nbAnimaux'   => $animalModel->compterParUtilisateur($userId),
            'nbVentes'    => $saleModel->compterParUtilisateur($userId),
            'totalVentes' => $saleModel->totalVentes($userId),
            'rappels'     => $healthModel->rappelsAVenir($userId),
        ];

        $this->render('dashboard/accueil', $donnees);
    }
}
