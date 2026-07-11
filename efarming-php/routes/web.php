<?php

$routes = [
    // Authentification
    'auth/connexion'          => ['AuthController', 'connexion'],
    'auth/traiterConnexion'   => ['AuthController', 'traiterConnexion'],
    'auth/inscription'        => ['AuthController', 'inscription'],
    'auth/traiterInscription' => ['AuthController', 'traiterInscription'],
    'auth/deconnexion'        => ['AuthController', 'deconnexion'],

    // Tableau de bord
    'dashboard/index'         => ['DashboardController', 'index'],

    // Animaux
    'animals/liste'               => ['AnimalController', 'liste'],
    'animals/ajouter'             => ['AnimalController', 'ajouter'],
    'animals/traiterAjout'        => ['AnimalController', 'traiterAjout'],
    'animals/modifier'            => ['AnimalController', 'modifier'],
    'animals/traiterModification' => ['AnimalController', 'traiterModification'],
    'animals/details'             => ['AnimalController', 'details'],
    'animals/supprimer'           => ['AnimalController', 'supprimer'],

    // Santé / Vaccination
    'health/liste'        => ['HealthController', 'liste'],
    'health/ajouter'      => ['HealthController', 'ajouter'],
    'health/traiterAjout' => ['HealthController', 'traiterAjout'],
    'health/supprimer'    => ['HealthController', 'supprimer'],

    // Ventes
    'sales/liste'        => ['SaleController', 'liste'],
    'sales/ajouter'      => ['SaleController', 'ajouter'],
    'sales/traiterAjout' => ['SaleController', 'traiterAjout'],
];
