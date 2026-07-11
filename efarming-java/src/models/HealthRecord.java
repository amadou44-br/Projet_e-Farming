package models;

import java.time.LocalDate;

public class HealthRecord {

    private static int compteur = 1;

    private final int id;
    private final int animalId;
    private TypeSoin type;
    private String description;
    private LocalDate dateEvenement;
    private LocalDate dateRappel; 

    public HealthRecord(int animalId, TypeSoin type, String description,
                         LocalDate dateEvenement, LocalDate dateRappel) {
        this.id = compteur++;
        this.animalId = animalId;
        this.type = type;
        this.description = description;
        this.dateEvenement = dateEvenement;
        this.dateRappel = dateRappel;
    }

    public int getId() {
        return id;
    }

    public int getAnimalId() {
        return animalId;
    }

    public TypeSoin getType() {
        return type;
    }

    public void setType(TypeSoin type) {
        this.type = type;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public LocalDate getDateEvenement() {
        return dateEvenement;
    }

    public void setDateEvenement(LocalDate dateEvenement) {
        this.dateEvenement = dateEvenement;
    }

    public LocalDate getDateRappel() {
        return dateRappel;
    }

    public void setDateRappel(LocalDate dateRappel) {
        this.dateRappel = dateRappel;
    }

    @Override
    public String toString() {
        String rappel = (dateRappel != null) ? dateRappel.toString() : "-";
        String desc = (description == null || description.isBlank()) ? "-" : description;
        return String.format("#%d | Animal #%d | %s | %s | Le: %s | Rappel: %s",
                id, animalId, type.getLibelle(), desc, dateEvenement, rappel);
    }
}
