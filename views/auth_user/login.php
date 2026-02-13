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

<?php require_once ROOT . '/views/templates/head.php'; ?>

<body class="login-page">
    <!-- Navigation -->
    <?php require_once ROOT . '/views/templates/nav.php'; ?>

    <!-- Main content -->
    <main class="main-login">
        <div class="login-container">
            <!-- Header -->
            <div class="login-header">
                <h1>Bon retour !</h1>
                <p>Connectez-vous pour rejoindre votre communauté</p>
            </div>

            <!-- Form card -->
            <div class="form-card">
                <!-- Error message (hidden by default) -->
                <div class="error-message" id="errorMessage">
                    Identifiants incorrects. Veuillez réessayer.
                </div>

                <form action="" method="POST" id="loginForm">
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="votre@email.com"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-input"
                                placeholder="••••••••" required>
                            <button type="button" class="password-toggle"></button>
                        </div>
                    </div>

                    <!-- Forgot password -->
                    <div class="form-checkbox-group">
                        <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-submit">Se connecter</button>
                </form>
                <!-- Sign up link -->
                <div class="signup-link">
                    Pas encore de compte ? <a href="index.php?action=register">Créer un compte</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>