package models;

public enum TypeSoin {
    VACCINATION("Vaccination"),
    TRAITEMENT("Traitement"),
    MALADIE("Maladie");

    private final String libelle;

    TypeSoin(String libelle) {
        this.libelle = libelle;
    }

    public String getLibelle() {
        return libelle;
    }
}
