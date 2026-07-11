package models;

import java.time.LocalDate;

public class Sale {

    private static int compteur = 1;

    private final int id;
    private final int animalId;
    private String acheteur;
    private double prix;
    private LocalDate dateVente;

    public Sale(int animalId, String acheteur, double prix, LocalDate dateVente) {
        this.id = compteur++;
        this.animalId = animalId;
        this.acheteur = acheteur;
        this.prix = prix;
        this.dateVente = dateVente;
    }

    public int getId() {
        return id;
    }

    public int getAnimalId() {
        return animalId;
    }

    public String getAcheteur() {
        return acheteur;
    }

    public void setAcheteur(String acheteur) {
        this.acheteur = acheteur;
    }

    public double getPrix() {
        return prix;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public LocalDate getDateVente() {
        return dateVente;
    }

    public void setDateVente(LocalDate dateVente) {
        this.dateVente = dateVente;
    }

    @Override
    public String toString() {
        return String.format("#%d | Animal #%d | Acheteur: %s | Prix: %.2f € | Le: %s",
                id, animalId, acheteur, prix, dateVente);
    }
}
