package services;

import models.Sale;

import java.util.ArrayList;
import java.util.List;

public class SaleService {

    private final List<Sale> ventes = new ArrayList<>();

    public Sale ajouter(Sale vente) {
        ventes.add(vente);
        return vente;
    }

    public List<Sale> listerToutes() {
        return new ArrayList<>(ventes);
    }

    public double totalVentes() {
        return ventes.stream().mapToDouble(Sale::getPrix).sum();
    }

    public int compterTotal() {
        return ventes.size();
    }
}
