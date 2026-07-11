package utils;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.Scanner;

public class Saisie {

    private static final DateTimeFormatter FORMAT_DATE = DateTimeFormatter.ofPattern("dd/MM/yyyy");

    private Saisie() {

    }

    public static String lireTexte(Scanner sc, String message) {
        System.out.print(message);
        return sc.nextLine().trim();
    }

    public static String lireTexteObligatoire(Scanner sc, String message) {
        String valeur;
        do {
            valeur = lireTexte(sc, message);
            if (valeur.isEmpty()) {
                System.out.println("⚠ Ce champ est obligatoire, réessaie.");
            }
        } while (valeur.isEmpty());
        return valeur;
    }

    public static int lireEntier(Scanner sc, String message) {
        while (true) {
            System.out.print(message);
            String saisie = sc.nextLine().trim();
            try {
                return Integer.parseInt(saisie);
            } catch (NumberFormatException e) {
                System.out.println("⚠ Merci d'entrer un nombre entier valide.");
            }
        }
    }

    public static double lireDecimal(Scanner sc, String message) {
        while (true) {
            System.out.print(message);
            String saisie = sc.nextLine().trim().replace(",", ".");
            try {
                return Double.parseDouble(saisie);
            } catch (NumberFormatException e) {
                System.out.println("⚠ Merci d'entrer un nombre valide (ex: 150.50).");
            }
        }
    }


    public static LocalDate lireDate(Scanner sc, String message) {
        while (true) {
            System.out.print(message + " (jj/mm/aaaa) : ");
            String saisie = sc.nextLine().trim();
            try {
                return LocalDate.parse(saisie, FORMAT_DATE);
            } catch (DateTimeParseException e) {
                System.out.println("⚠ Format invalide. Utilise le format jj/mm/aaaa (ex: 25/12/2024).");
            }
        }
    }

    public static LocalDate lireDateOptionnelle(Scanner sc, String message) {
        while (true) {
            System.out.print(message + " (jj/mm/aaaa, ou Entrée pour ignorer) : ");
            String saisie = sc.nextLine().trim();
            if (saisie.isEmpty()) {
                return null;
            }
            try {
                return LocalDate.parse(saisie, FORMAT_DATE);
            } catch (DateTimeParseException e) {
                System.out.println("⚠ Format invalide. Utilise le format jj/mm/aaaa, ou laisse vide.");
            }
        }
    }

    public static String formaterDate(LocalDate date) {
        return (date != null) ? date.format(FORMAT_DATE) : "-";
    }
}
