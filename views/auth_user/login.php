<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'];

    $errors = [];
    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Le format de l'email est invalide.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est obligatoire.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir plus de 8 caractères";
    }

    if (!$errors) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['pseudo'],
                'role' => $user['role']
            ];
            header('Location: index.php?action=home');
            exit;
        }
    } else {
        echo 'utilisateur introuvable';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <div class="">
            <label for="email">Adresse Email :</label>
            <input type="email" name="email" id="email" required autocomplete="email" placeholder="exemple@domaine.com">
        </div>

        <div class="">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
        </div>

        <button type="submit" name="btn_login">Se connecter</button>

    </form>
</body>

</html>