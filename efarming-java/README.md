# e-Farming — Version console (Java)

Application de gestion d'élevage en ligne de commande, écrite en Java pur.
**Aucune base de données** : toutes les données sont stockées en mémoire
pendant l'exécution du programme (elles sont donc perdues à chaque fermeture).

## Fonctionnalités

- Gestion des animaux (ajouter, lister, voir détails, modifier, supprimer)
- Suivi santé / vaccinations (ajouter un soin, lister, voir les rappels à venir)
- Ventes (enregistrer une vente, lister les ventes — marque automatiquement
  l'animal comme "Vendu")
- Tableau de bord (statistiques globales)

## Architecture (MVC simplifié, sans dépendance externe)

```
src/
├── Main.java              ← point d'entrée + tous les menus console
├── models/
│   ├── Animal.java
│   ├── HealthRecord.java
│   ├── Sale.java
│   ├── Sexe.java           (enum)
│   ├── StatutAnimal.java   (enum)
│   └── TypeSoin.java       (enum)
├── services/               ← logique métier (équivalent des "contrôleurs")
│   ├── AnimalService.java
│   ├── HealthService.java
│   └── SaleService.java
└── utils/
    └── Saisie.java          ← lecture/validation sécurisée des entrées clavier
```

## Compiler et lancer

Depuis la racine du projet (dossier contenant `src/`) :

```bash
# Compilation
javac -encoding UTF-8 -d out $(find src -name "*.java")

# Exécution
java -Dfile.encoding=UTF-8 -cp out Main
```

**Sous Windows (PowerShell/CMD)**, si les accents s'affichent mal dans la
console, exécute d'abord :

```powershell
chcp 65001
```

Puis relance le programme normalement.

## Compiler et lancer depuis un IDE (Eclipse / IntelliJ / VS Code)

1. Importe le dossier comme projet Java existant
2. Assure-toi que le dossier `src` est bien marqué comme "Source Folder" / "Sources Root"
3. Lance la classe `Main`

## Notes

- Les identifiants (ID) des animaux, soins et ventes sont générés
  automatiquement (compteur interne), pas besoin de les saisir.
- Les dates se saisissent au format `jj/mm/aaaa` (ex: `25/12/2024`).
- Comme il n'y a pas de base de données, ce programme est idéal pour un
  usage de démonstration ou d'apprentissage — pour une persistance réelle,
  il faudrait ajouter une sauvegarde fichier (CSV/JSON) ou une base de données.
