<h1>Ajouter un animal</h1>

<form method="POST" action="index.php?route=animals/traiterAjout" class="formulaire">
    <label>Identifiant (tag/boucle)</label>
    <input type="text" name="identifiant" required>

    <label>Espèce</label>
    <select name="espece" required>
        <option value="Bovin">Bovin</option>
        <option value="Ovin">Ovin</option>
        <option value="Caprin">Caprin</option>
        <option value="Volaille">Volaille</option>
        <option value="Autre">Autre</option>
    </select>

    <label>Race</label>
    <input type="text" name="race">

    <label>Sexe</label>
    <select name="sexe" required>
        <option value="Male">Mâle</option>
        <option value="Femelle">Femelle</option>
    </select>

    <label>Date de naissance</label>
    <input type="date" name="date_naissance">

    <button type="submit">Enregistrer</button>
</form>

<a href="index.php?route=animals/liste">← Retour à la liste</a>
