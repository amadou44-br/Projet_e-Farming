package models;

import java.time.LocalDate;

public class Animal {

    private static int compteur = 1;

    private final int id;
    private String identifiant; 
    private String espece;
    private String race;
    private Sexe sexe;
    private LocalDate dateNaissance;
    private StatutAnimal statut;

    public Animal(String identifiant, String espece, String race, Sexe sexe, LocalDate dateNaissance) {
        this.id = compteur++;
        this.identifiant = identifiant;
        this.espece = espece;
        this.race = race;
        this.sexe = sexe;
        this.dateNaissance = dateNaissance;
        this.statut = StatutAnimal.ACTIF;
    }

    public int getId() {
        return id;
    }

    public String getIdentifiant() {
        return identifiant;
    }

    public void setIdentifiant(String identifiant) {
        this.identifiant = identifiant;
    }

    public String getEspece() {
        return espece;
    }

    public void setEspece(String espece) {
        this.espece = espece;
    }

    public String getRace() {
        return race;
    }

    public void setRace(String race) {
        this.race = race;
    }

    public Sexe getSexe() {
        return sexe;
    }

    public void setSexe(Sexe sexe) {
        this.sexe = sexe;
    }

    public LocalDate getDateNaissance() {
        return dateNaissance;
    }

    public void setDateNaissance(LocalDate dateNaissance) {
        this.dateNaissance = dateNaissance;
    }

    public StatutAnimal getStatut() {
        return statut;
    }

    public void setStatut(StatutAnimal statut) {
        this.statut = statut;
    }

    @Override
    public String toString() {
        String naissance = (dateNaissance != null) ? dateNaissance.toString() : "-";
        return String.format("#%d | %s | %s | %s | %s | Né(e) le: %s | Statut: %s",
                id, identifiant, espece, (race == null || race.isBlank()) ? "-" : race,
                sexe.getLibelle(), naissance, statut.getLibelle());
    }
}
