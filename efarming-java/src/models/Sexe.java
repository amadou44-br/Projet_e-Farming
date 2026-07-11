package models;

public enum Sexe {
    MALE("Mâle"),
    FEMELLE("Femelle");

    private final String libelle;

    Sexe(String libelle) {
        this.libelle = libelle;
    }

    public String getLibelle() {
        return libelle;
    }
}
