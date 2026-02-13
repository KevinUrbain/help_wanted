<?php
if ($_SESSION['user']) {
    header('Location: index.php?action=login');
    exit;
}
$username = $_SESSION['user']['username'];
?>

<h1>Bienvenue <?= $username ?></h1>
<a href="index.php?action=logout">Se déconnecter</a>