<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - UAT</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="index.html" class="logo"><img src="images/logo.webp" alt="Logo de l'UAT"></a>
      <div class="brand-text">
        <h1>UNIVERSITÉ AFRICAINE DES TECHNOLOGIES</h1>
        <p class="devise">« Former aujourd'hui les innovateurs de demain »</p>
      </div>
    </div>
    <button class="menu-toggle" id="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="menu">
      <a href="index.html">Accueil</a>
      <a href="formations.html">Formations</a>
      <a href="actualites.html">Actualités</a>
      <a href="inscription.php" class="active">Inscription</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>Formulaire d'inscription</h2>
      <?php require __DIR__ . '/traitement_inscription.php'; ?>
      <?php if ($succes): ?><div class="msg success">Inscription enregistrée avec succès.</div><?php endif; ?>
      <?php if ($erreurs): ?><div class="msg error"><ul><?php foreach ($erreurs as $e): ?><li><?= h($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
      <form action="inscription.php" method="post" id="form-inscription">

        <fieldset>
          <legend>Informations personnelles</legend>
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="nom" value="<?= old('nom') ?>" required>

          <label for="prenom">Prénom :</label>
          <input type="text" id="prenom" name="prenom" value="<?= old('prenom') ?>" required>

          <label for="naissance">Date de naissance :</label>
          <input type="date" id="naissance" name="naissance" value="<?= old('naissance') ?>" required>

          <p class="label">Sexe :</p>
          <label class="inline"><input type="radio" name="sexe" value="M" <?= old('sexe')==='M' ? 'checked' : '' ?> required> Masculin</label>
          <label class="inline"><input type="radio" name="sexe" value="F" <?= old('sexe')==='F' ? 'checked' : '' ?>> Féminin</label>

          <label for="adresse">Adresse :</label>
          <input type="text" id="adresse" name="adresse" value="<?= old('adresse') ?>">

          <label for="ville">Ville :</label>
          <input type="text" id="ville" name="ville" value="<?= old('ville') ?>">

          <label for="tel">Téléphone :</label>
          <input type="tel" id="tel" name="tel" value="<?= old('tel') ?>">

          <label for="email">Adresse électronique :</label>
          <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
        </fieldset>

        <fieldset>
          <legend>Informations académiques</legend>
          <label for="formation">Formation :</label>
          <select id="formation" name="formation" required>
            <option value="">-- Sélectionner une formation --</option>
            <option <?= old('formation')==='Licence Informatique' ? 'selected' : '' ?>>Licence Informatique</option>
            <option <?= old('formation')==='Licence Mathématiques' ? 'selected' : '' ?>>Licence Mathématiques</option>
            <option <?= old('formation')==='Licence Data Science' ? 'selected' : '' ?>>Licence Data Science</option>
            <option <?= old('formation')==='Licence Réseaux' ? 'selected' : '' ?>>Licence Réseaux</option>
            <option <?= old('formation')==='Master Intelligence Artificielle' ? 'selected' : '' ?>>Master Intelligence Artificielle</option>
          </select>

          <p class="label">Niveau d'étude :</p>
          <label class="inline"><input type="radio" name="niveau" value="L1" <?= old('niveau')==='L1' ? 'checked' : '' ?> required> Licence 1</label>
          <label class="inline"><input type="radio" name="niveau" value="L2" <?= old('niveau')==='L2' ? 'checked' : '' ?>> Licence 2</label>
          <label class="inline"><input type="radio" name="niveau" value="L3" <?= old('niveau')==='L3' ? 'checked' : '' ?>> Licence 3</label>
          <label class="inline"><input type="radio" name="niveau" value="M1" <?= old('niveau')==='M1' ? 'checked' : '' ?>> Master 1</label>
          <label class="inline"><input type="radio" name="niveau" value="M2" <?= old('niveau')==='M2' ? 'checked' : '' ?>> Master 2</label>

          <p class="label">Langues parlées :</p>
          <label class="inline"><input type="checkbox" name="langues[]" value="fr" <?= in_array('fr', $languesSelectionnees, true) ? 'checked' : '' ?>> Français</label>
          <label class="inline"><input type="checkbox" name="langues[]" value="en" <?= in_array('en', $languesSelectionnees, true) ? 'checked' : '' ?>> Anglais</label>
          <label class="inline"><input type="checkbox" name="langues[]" value="fon" <?= in_array('fon', $languesSelectionnees, true) ? 'checked' : '' ?>> Fon</label>
          <label class="inline"><input type="checkbox" name="langues[]" value="yoruba" <?= in_array('yoruba', $languesSelectionnees, true) ? 'checked' : '' ?>> Yoruba</label>
          <label class="inline"><input type="checkbox" name="langues[]" value="baatonum" <?= in_array('baatonum', $languesSelectionnees, true) ? 'checked' : '' ?>> Baatonum</label>

          <label for="motivation">Lettre de motivation :</label>
          <textarea id="motivation" name="motivation" rows="6" placeholder="Expliquez en quelques lignes le choix de votre formation..."><?= old('motivation') ?></textarea>
        </fieldset>

        <fieldset>
          <legend>Sécurité</legend>
          <label for="mdp">Mot de passe :</label>
          <input type="password" id="mdp" name="mdp" required minlength="6">

          <label for="mdp2">Confirmation du mot de passe :</label>
          <input type="password" id="mdp2" name="mdp2" required>
        </fieldset>

        <div class="actions">
          <input type="submit" value="Envoyer">
          <input type="reset" value="Réinitialiser">
        </div>
      </form>
    </section>
  </main>

  <footer>
    <p>© 2026 Université Africaine des Technologies</p>
    <p>Contact : <a href="mailto:contact@uat.edu">contact@uat.edu</a></p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
