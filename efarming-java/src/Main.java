import models.*;
import services.AnimalService;
import services.HealthService;
import services.SaleService;
import utils.Saisie;

import java.io.PrintStream;
import java.nio.charset.StandardCharsets;
import java.util.List;
import java.util.Scanner;


public class Main {

    private static final Scanner sc = new Scanner(System.in, StandardCharsets.UTF_8);
    private static final AnimalService animalService = new AnimalService();
    private static final HealthService healthService = new HealthService();
    private static final SaleService saleService = new SaleService();

    public static void main(String[] args) {
        System.setOut(new PrintStream(System.out, true, StandardCharsets.UTF_8));

        System.out.println("=========================================");
        System.out.println("   Bienvenue sur e-Farming (mode console) ");
        System.out.println("=========================================");

        boolean continuer = true;
        while (continuer) {
            afficherMenuPrincipal();
            int choix = Saisie.lireEntier(sc, "Ton choix : ");

            switch (choix) {
                case 1 -> menuAnimaux();
                case 2 -> menuSante();
                case 3 -> menuVentes();
                case 4 -> afficherTableauDeBord();
                case 0 -> continuer = false;
                default -> System.out.println("⚠ Choix invalide, réessaie.");
            }
        }

        System.out.println("\nÀ bientôt sur e-Farming !");
        sc.close();
    }

    private static void afficherMenuPrincipal() {
        System.out.println("\n----------- MENU PRINCIPAL -----------");
        System.out.println("1. Gestion des animaux");
        System.out.println("2. Santé / Vaccinations");
        System.out.println("3. Ventes");
        System.out.println("4. Tableau de bord");
        System.out.println("0. Quitter");
        System.out.println("---------------------------------------");
    }

    private static void menuAnimaux() {
        boolean retour = false;
        while (!retour) {
            System.out.println("\n----- Gestion des animaux -----");
            System.out.println("1. Ajouter un animal");
            System.out.println("2. Lister les animaux");
            System.out.println("3. Voir les détails d'un animal");
            System.out.println("4. Modifier un animal");
            System.out.println("5. Supprimer un animal");
            System.out.println("0. Retour");

            int choix = Saisie.lireEntier(sc, "Ton choix : ");
            switch (choix) {
                case 1 -> ajouterAnimal();
                case 2 -> listerAnimaux();
                case 3 -> afficherDetailsAnimal();
                case 4 -> modifierAnimal();
                case 5 -> supprimerAnimal();
                case 0 -> retour = true;
                default -> System.out.println("⚠ Choix invalide, réessaie.");
            }
        }
    }

    private static void ajouterAnimal() {
        System.out.println("\n-- Ajouter un animal --");

        String identifiant;
        do {
            identifiant = Saisie.lireTexteObligatoire(sc, "Identifiant (tag/boucle) : ");
            if (animalService.identifiantExiste(identifiant)) {
                System.out.println("⚠ Cet identifiant existe déjà, choisis-en un autre.");
                identifiant = "";
            }
        } while (identifiant.isEmpty());

        String espece = Saisie.lireTexteObligatoire(sc, "Espèce (Bovin/Ovin/Caprin/Volaille/Autre) : ");
        String race = Saisie.lireTexte(sc, "Race (optionnel) : ");
        Sexe sexe = choisirSexe();
        var dateNaissance = Saisie.lireDateOptionnelle(sc, "Date de naissance");

        Animal animal = new Animal(identifiant, espece, race, sexe, dateNaissance);
        animalService.ajouter(animal);

        System.out.println("✅ Animal ajouté avec succès : " + animal);
    }

    private static void listerAnimaux() {
        System.out.println("\n-- Liste des animaux --");
        List<Animal> animaux = animalService.listerTous();

        if (animaux.isEmpty()) {
            System.out.println("Aucun animal enregistré pour le moment.");
            return;
        }

        for (Animal a : animaux) {
            System.out.println(a);
        }
    }

    private static void afficherDetailsAnimal() {
        int id = Saisie.lireEntier(sc, "\nID de l'animal : ");
        var animalOpt = animalService.trouverParId(id);

        if (animalOpt.isEmpty()) {
            System.out.println("⚠ Aucun animal trouvé avec cet ID.");
            return;
        }

        Animal animal = animalOpt.get();
        System.out.println("\n-- Détails de l'animal --");
        System.out.println(animal);

        System.out.println("\nHistorique des soins / vaccinations :");
        List<HealthRecord> historique = healthService.listerParAnimal(id);
        if (historique.isEmpty()) {
            System.out.println("Aucun soin enregistré pour cet animal.");
        } else {
            for (HealthRecord h : historique) {
                System.out.println(h);
            }
        }
    }

    private static void modifierAnimal() {
        int id = Saisie.lireEntier(sc, "\nID de l'animal à modifier : ");
        var animalOpt = animalService.trouverParId(id);

        if (animalOpt.isEmpty()) {
            System.out.println("⚠ Aucun animal trouvé avec cet ID.");
            return;
        }

        Animal animal = animalOpt.get();
        System.out.println("Animal actuel : " + animal);
        System.out.println("(Laisse vide pour garder la valeur actuelle)");

        String identifiant = Saisie.lireTexte(sc, "Nouvel identifiant [" + animal.getIdentifiant() + "] : ");
        if (!identifiant.isEmpty()) animal.setIdentifiant(identifiant);

        String espece = Saisie.lireTexte(sc, "Nouvelle espèce [" + animal.getEspece() + "] : ");
        if (!espece.isEmpty()) animal.setEspece(espece);

        String race = Saisie.lireTexte(sc, "Nouvelle race [" + animal.getRace() + "] : ");
        if (!race.isEmpty()) animal.setRace(race);

        System.out.println("Statut actuel : " + animal.getStatut().getLibelle());
        System.out.println("1. Actif  2. Vendu  3. Décédé  (Entrée pour ne pas changer)");
        String choixStatut = Saisie.lireTexte(sc, "Nouveau statut : ");
        switch (choixStatut) {
            case "1" -> animal.setStatut(StatutAnimal.ACTIF);
            case "2" -> animal.setStatut(StatutAnimal.VENDU);
            case "3" -> animal.setStatut(StatutAnimal.DECEDE);
            default -> { /* on garde le statut actuel */ }
        }

        System.out.println("✅ Animal mis à jour : " + animal);
    }

    private static void supprimerAnimal() {
        int id = Saisie.lireEntier(sc, "\nID de l'animal à supprimer : ");
        if (animalService.supprimer(id)) {
            System.out.println("✅ Animal supprimé.");
        } else {
            System.out.println("⚠ Aucun animal trouvé avec cet ID.");
        }
    }

    private static Sexe choisirSexe() {
        while (true) {
            System.out.print("Sexe (1 = Mâle, 2 = Femelle) : ");
            String saisie = sc.nextLine().trim();
            if (saisie.equals("1")) return Sexe.MALE;
            if (saisie.equals("2")) return Sexe.FEMELLE;
            System.out.println("⚠ Choix invalide, entre 1 ou 2.");
        }
    }

    private static void menuSante() {
        boolean retour = false;
        while (!retour) {
            System.out.println("\n----- Santé / Vaccinations -----");
            System.out.println("1. Ajouter un soin/vaccination");
            System.out.println("2. Lister tous les soins");
            System.out.println("3. Voir les rappels à venir");
            System.out.println("0. Retour");

            int choix = Saisie.lireEntier(sc, "Ton choix : ");
            switch (choix) {
                case 1 -> ajouterSoin();
                case 2 -> listerSoins();
                case 3 -> afficherRappels();
                case 0 -> retour = true;
                default -> System.out.println("⚠ Choix invalide, réessaie.");
            }
        }
    }

    private static void ajouterSoin() {
        if (animalService.compterTotal() == 0) {
            System.out.println("⚠ Aucun animal enregistré. Ajoute d'abord un animal.");
            return;
        }

        System.out.println("\n-- Ajouter un soin / vaccination --");
        int animalId = Saisie.lireEntier(sc, "ID de l'animal concerné : ");

        if (animalService.trouverParId(animalId).isEmpty()) {
            System.out.println("⚠ Aucun animal trouvé avec cet ID.");
            return;
        }

        TypeSoin type = choisirTypeSoin();
        String description = Saisie.lireTexte(sc, "Description (optionnel) : ");
        var dateEvenement = Saisie.lireDate(sc, "Date de l'événement");
        var dateRappel = Saisie.lireDateOptionnelle(sc, "Date de rappel");

        HealthRecord soin = new HealthRecord(animalId, type, description, dateEvenement, dateRappel);
        healthService.ajouter(soin);

        System.out.println("✅ Soin enregistré : " + soin);
    }

    private static void listerSoins() {
        System.out.println("\n-- Liste de tous les soins --");
        List<HealthRecord> soins = healthService.listerTous();

        if (soins.isEmpty()) {
            System.out.println("Aucun soin enregistré.");
            return;
        }

        for (HealthRecord h : soins) {
            System.out.println(h);
        }
    }

    private static void afficherRappels() {
        System.out.println("\n-- Rappels de vaccination à venir --");
        List<HealthRecord> rappels = healthService.rappelsAVenir();

        if (rappels.isEmpty()) {
            System.out.println("Aucun rappel à venir.");
            return;
        }

        for (HealthRecord h : rappels) {
            System.out.println(h);
        }
    }

    private static TypeSoin choisirTypeSoin() {
        while (true) {
            System.out.print("Type (1 = Vaccination, 2 = Traitement, 3 = Maladie) : ");
            String saisie = sc.nextLine().trim();
            switch (saisie) {
                case "1": return TypeSoin.VACCINATION;
                case "2": return TypeSoin.TRAITEMENT;
                case "3": return TypeSoin.MALADIE;
                default: System.out.println("⚠ Choix invalide, entre 1, 2 ou 3.");
            }
        }
    }

    private static void menuVentes() {
        boolean retour = false;
        while (!retour) {
            System.out.println("\n----- Ventes -----");
            System.out.println("1. Enregistrer une vente");
            System.out.println("2. Lister les ventes");
            System.out.println("0. Retour");

            int choix = Saisie.lireEntier(sc, "Ton choix : ");
            switch (choix) {
                case 1 -> enregistrerVente();
                case 2 -> listerVentes();
                case 0 -> retour = true;
                default -> System.out.println("⚠ Choix invalide, réessaie.");
            }
        }
    }

    private static void enregistrerVente() {
        List<Animal> disponibles = animalService.listerActifs();

        if (disponibles.isEmpty()) {
            System.out.println("⚠ Aucun animal disponible à la vente (aucun animal actif).");
            return;
        }

        System.out.println("\n-- Animaux disponibles à la vente --");
        for (Animal a : disponibles) {
            System.out.println(a);
        }

        int animalId = Saisie.lireEntier(sc, "\nID de l'animal à vendre : ");
        var animalOpt = animalService.trouverParId(animalId);

        if (animalOpt.isEmpty() || animalOpt.get().getStatut() != StatutAnimal.ACTIF) {
            System.out.println("⚠ Cet animal n'est pas disponible à la vente.");
            return;
        }

        String acheteur = Saisie.lireTexteObligatoire(sc, "Nom de l'acheteur : ");
        double prix = Saisie.lireDecimal(sc, "Prix de vente (€) : ");
        var dateVente = Saisie.lireDate(sc, "Date de la vente");

        Sale vente = new Sale(animalId, acheteur, prix, dateVente);
        saleService.ajouter(vente);
        animalService.marquerCommeVendu(animalId);

        System.out.println("✅ Vente enregistrée : " + vente);
    }

    private static void listerVentes() {
        System.out.println("\n-- Liste des ventes --");
        List<Sale> ventes = saleService.listerToutes();

        if (ventes.isEmpty()) {
            System.out.println("Aucune vente enregistrée.");
            return;
        }

        for (Sale v : ventes) {
            System.out.println(v);
        }
    }

    private static void afficherTableauDeBord() {
        System.out.println("\n========== TABLEAU DE BORD ==========");
        System.out.println("Animaux enregistrés : " + animalService.compterTotal());
        System.out.println("Ventes réalisées      : " + saleService.compterTotal());
        System.out.printf("Total des ventes      : %.2f €%n", saleService.totalVentes());

        System.out.println("\nProchains rappels de vaccination :");
        List<HealthRecord> rappels = healthService.rappelsAVenir();
        if (rappels.isEmpty()) {
            System.out.println("Aucun rappel à venir.");
        } else {
            for (HealthRecord h : rappels) {
                System.out.println(h);
            }
        }
        System.out.println("======================================");
    }
}
