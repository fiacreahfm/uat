<?php
// Dashboard : http://127.0.0.1:8080/dashboard.php
require_once __DIR__ . '/db.php';
$rows = db()->query('SELECT id, nom, prenom, naissance, sexe, ville, tel, email, formation, niveau, langues, created_at
                     FROM inscriptions ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - UAT</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="index.html" class="logo"><img src="images/logo.webp" alt="Logo de l'UAT"></a>
      <div class="brand-text"><h1>UAT — Dashboard</h1></div>
    </div>
  </header>
  <main style="max-width:1200px">
    <h2>Inscriptions enregistrées (<?= count($rows) ?>)</h2>
    <div class="table-wrap">
      <table>
        <thead><tr><th>#</th><th>Nom</th><th>Prénom</th><th>Naissance</th><th>Sexe</th><th>Ville</th><th>Téléphone</th><th>Email</th><th>Formation</th><th>Niveau</th><th>Langues</th><th>Date</th></tr></thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= (int)$r['id'] ?></td><td><?= h($r['nom']) ?></td><td><?= h($r['prenom']) ?></td>
            <td><?= h($r['naissance']) ?></td><td><?= h($r['sexe']) ?></td><td><?= h((string)$r['ville']) ?></td>
            <td><?= h((string)$r['tel']) ?></td><td><?= h($r['email']) ?></td><td><?= h($r['formation']) ?></td>
            <td><?= h($r['niveau']) ?></td><td><?= h((string)$r['langues']) ?></td><td><?= h($r['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$rows): ?><tr><td colspan="12">Aucune inscription.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
