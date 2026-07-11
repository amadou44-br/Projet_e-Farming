package models;

public enum StatutAnimal {
    ACTIF("Actif"),
    VENDU("Vendu"),
    DECEDE("Décédé");

    private final String libelle;

    StatutAnimal(String libelle) {
        this.libelle = libelle;
    }

    public String getLibelle() {
        return libelle;
    }
}
