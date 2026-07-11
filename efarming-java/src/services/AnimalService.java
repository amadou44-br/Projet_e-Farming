package services;

import models.Animal;
import models.StatutAnimal;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

public class AnimalService {

    private final List<Animal> animaux = new ArrayList<>();

    public Animal ajouter(Animal animal) {
        animaux.add(animal);
        return animal;
    }

    public List<Animal> listerTous() {
        return new ArrayList<>(animaux);
    }

    public Optional<Animal> trouverParId(int id) {
        return animaux.stream().filter(a -> a.getId() == id).findFirst();
    }

    public boolean identifiantExiste(String identifiant) {
        return animaux.stream().anyMatch(a -> a.getIdentifiant().equalsIgnoreCase(identifiant));
    }

    public boolean supprimer(int id) {
        return animaux.removeIf(a -> a.getId() == id);
    }

    public void marquerCommeVendu(int id) {
        trouverParId(id).ifPresent(a -> a.setStatut(StatutAnimal.VENDU));
    }

    public List<Animal> listerActifs() {
        return animaux.stream()
                .filter(a -> a.getStatut() == StatutAnimal.ACTIF)
                .toList();
    }

    public int compterTotal() {
        return animaux.size();
    }
}
