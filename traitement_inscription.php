<?php
require_once __DIR__ . '/db.php';

$erreurs = [];
$succes  = false;
$languesSelectionnees = $_POST['langues'] ?? [];
if (!is_array($languesSelectionnees)) {
    $languesSelectionnees = [];
} else {
    $languesSelectionnees = array_values(array_filter($languesSelectionnees, 'is_string'));
}

function old(string $k): string {
    return isset($_POST[$k]) && is_string($_POST[$k]) ? h($_POST[$k]) : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $get = fn(string $k) => isset($_POST[$k]) && is_string($_POST[$k]) ? trim($_POST[$k]) : '';

    $nom = $get('nom'); $prenom = $get('prenom'); $naissance = $get('naissance');
    $sexe = $get('sexe'); $adresse = $get('adresse'); $ville = $get('ville');
    $tel = $get('tel'); $email = $get('email'); $formation = $get('formation');
    $niveau = $get('niveau'); $motivation = $get('motivation');
    $mdp = isset($_POST['mdp']) && is_string($_POST['mdp']) ? $_POST['mdp'] : '';
    $mdp2 = isset($_POST['mdp2']) && is_string($_POST['mdp2']) ? $_POST['mdp2'] : '';
    $languesRecues = $_POST['langues'] ?? [];
    $langues = is_array($languesRecues)
        ? array_values(array_filter($languesRecues, 'is_string'))
        : [];
    $languesBienFormatees = is_array($languesRecues)
        && count($langues) === count($languesRecues);

    $formationsOk = ['Licence Informatique','Licence Mathématiques','Licence Data Science','Licence Réseaux','Master Intelligence Artificielle'];
    $languesOk = ['fr','en','fon','yoruba','baatonum'];

    if ($nom === '' || mb_strlen($nom) > 80) $erreurs[] = 'Nom obligatoire (80 caractères max).';
    if ($prenom === '' || mb_strlen($prenom) > 80) $erreurs[] = 'Prénom obligatoire (80 caractères max).';
    $d = DateTime::createFromFormat('Y-m-d', $naissance);
    if (!$d || $d->format('Y-m-d') !== $naissance || $d > new DateTime()) $erreurs[] = 'Date de naissance invalide.';
    if (!in_array($sexe, ['M','F'], true)) $erreurs[] = 'Sexe invalide.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = 'Adresse électronique invalide.';
    if (!in_array($formation, $formationsOk, true)) $erreurs[] = 'Veuillez choisir une formation.';
    if (!in_array($niveau, ['L1','L2','L3','M1','M2'], true)) $erreurs[] = "Niveau d'étude invalide.";
    if ($tel !== '' && !preg_match('/^[0-9+\s().-]{6,30}$/', $tel)) $erreurs[] = 'Numéro de téléphone invalide.';
    if (!$languesBienFormatees || array_diff($langues, $languesOk)) $erreurs[] = 'Langue invalide.';
    if (strlen($mdp) < 6) $erreurs[] = 'Le mot de passe doit contenir au moins 6 caractères.';
    if ($mdp !== $mdp2) $erreurs[] = 'Les mots de passe ne correspondent pas.';

    if (!$erreurs) {
        try {
            $st = db()->prepare('INSERT INTO inscriptions
              (nom, prenom, naissance, sexe, adresse, ville, tel, email, formation, niveau, langues, motivation, mot_de_passe)
              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $st->execute([$nom, $prenom, $naissance, $sexe, $adresse ?: null, $ville ?: null, $tel ?: null,
                          $email, $formation, $niveau, implode(',', $langues), $motivation ?: null,
                          password_hash($mdp, PASSWORD_DEFAULT)]);
            $succes = true;
            $_POST = []; // vider le formulaire
            $languesSelectionnees = [];
        } catch (PDOException $e) {
            $erreurs[] = ($e->getCode() === '23000')
                ? 'Cette adresse électronique est déjà inscrite.'
                : "Erreur d'enregistrement, réessayez plus tard.";
        }
    }
}
