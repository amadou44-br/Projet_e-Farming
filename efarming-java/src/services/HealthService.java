package services;

import models.HealthRecord;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;

public class HealthService {

    private final List<HealthRecord> soins = new ArrayList<>();

    public HealthRecord ajouter(HealthRecord soin) {
        soins.add(soin);
        return soin;
    }

    public List<HealthRecord> listerTous() {
        return new ArrayList<>(soins);
    }

    public List<HealthRecord> listerParAnimal(int animalId) {
        return soins.stream()
                .filter(s -> s.getAnimalId() == animalId)
                .toList();
    }

    public boolean supprimer(int id) {
        return soins.removeIf(s -> s.getId() == id);
    }

    public List<HealthRecord> rappelsAVenir() {
        LocalDate aujourdHui = LocalDate.now();
        return soins.stream()
                .filter(s -> s.getDateRappel() != null && !s.getDateRappel().isBefore(aujourdHui))
                .sorted(Comparator.comparing(HealthRecord::getDateRappel))
                .toList();
    }
}
