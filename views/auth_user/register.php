<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'];
    $street = trim($_POST['street'] ?? '');
    $numberStreet = trim($_POST['number_street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $zip = trim($_POST['zip_code'] ?? '');
    $phone = trim($_POST['phone_number'] ?? '');
    $profil = trim($_POST['profil'] ?? '');

    $errors = [];
    if (empty($firstname)) {
        $errors['firstname'] = "Le prénom est obligatoire.";
    }

    if (empty($lastname)) {
        $errors['lastname'] = "Le nom est obligatoire.";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Le format de l'email est invalide.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est obligatoire.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir plus de 8 caractères";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($profil)) {
        $errors['profil'] = "Le choix du profil est obligatoire.";
    }

    if (empty($phone)) {
        $errors['phone'] = "Le numéro de téléphone est obligatoire.";
    } elseif (strlen($phone) < 13) {
        $errors['phone'] = "Le numéro de téléphone n'est pas valide";
    }

    if (empty($street)) {
        $errors['street'] = "La rue est obligatoire.";
    }

    if (empty($city)) {
        $errors['city'] = "La ville est obligatoire.";
    }

    if (empty($zip)) {
        $errors['zip_code'] = "Le code postal est obligatoire.";
    } elseif (strlen($zip) < 5) {
        $errors['zip_code'] = "Le code postal est obligatoire.";
    }

    if (!empty($errors)) {
        $sql = "INSERT INTO users (firstname, lastname, pseudo, email, password, street, number_street, city, zip_code, phone_number, profil) VALUES (:firstname, :lastname, :pseudo, :email, :password, :street, :number_street, :city, :zip_code, :phone_number, :profil)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':pseudo' => $username,
            ':password' => $password,
            ':street' => $street,
            ':city' => $city,
            ':number_street' => $numberStreet,
            ':zip_code' => $zip,
            ':phone_number' => $phone,
            ':profil' => $profil
        ]);
        if ($result) {
            header('Location: index.php?action=login');
            exit;
        } else {

        }
    } else {

    }


}
?>

<!DOCTYPE html>
<html lang="fr">

<?php require_once ROOT . '/views/templates/head.php' ?>

<body class="login-page">
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="help-wanted.html" class="logo">Help Wanted</a>
        </div>
    </nav>

    <!-- Main content -->
    <main class="main-login">
        <div class="login-container register-container">
            <!-- Header -->
            <div class="login-header">
                <h1>Rejoignez-nous !</h1>
                <p>Créez votre compte et participez à la solidarité de quartier</p>
            </div>

            <!-- Form card -->
            <div class="form-card">
                <!-- Error message (hidden by default) -->
                <div class="error-message" id="errorMessage">
                    Veuillez remplir tous les champs obligatoires.
                </div>

                <form id="registerForm">
                    <div class="form-row">
                        <!-- Prénom -->
                        <div class="form-group">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-input" placeholder="Jean" required>
                        </div>

                        <!-- Nom -->
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-input" placeholder="Dupont" required>
                        </div>

                        <!-- Pseudo -->
                        <div class="form-group full-width">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" class="form-input" placeholder="jean.dupont"
                                required>
                        </div>

                        <!-- Email -->
                        <div class="form-group full-width">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input"
                                placeholder="jean.dupont@example.com" required>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" class="form-input"
                                    placeholder="••••••••" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- Rue -->
                        <div class="form-group">
                            <label for="rue" class="form-label">Rue</label>
                            <input type="text" id="rue" name="rue" class="form-input" placeholder="Rue de la Paix"
                                required>
                        </div>

                        <!-- Numéro -->
                        <div class="form-group">
                            <label for="numero" class="form-label">Numéro</label>
                            <input type="text" id="numero" name="numero" class="form-input" placeholder="42" required>
                        </div>

                        <!-- Ville -->
                        <div class="form-group">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" id="ville" name="ville" class="form-input" placeholder="Bruxelles"
                                required>
                        </div>

                        <!-- Code Postal -->
                        <div class="form-group">
                            <label for="codePostal" class="form-label">Code Postal</label>
                            <input type="text" id="codePostal" name="codePostal" class="form-input" placeholder="1000"
                                required>
                        </div>

                        <!-- Numéro de téléphone -->
                        <div class="form-group full-width">
                            <label for="telephone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" id="telephone" name="telephone" class="form-input"
                                placeholder="+32 123 45 67 89" required>
                        </div>

                        <!-- Photo de profil -->
                        <div class="form-group full-width">
                            <label class="form-label">Votre profil</label>
                            <div class="profile-upload">
                                <img id="profilePreview" class="profile-preview" src="" alt="Preview">
                                <div class="upload-icon">📷</div>
                                <div class="upload-text">
                                    <strong>Cliquez pour télécharger</strong> ou glissez une photo<br>
                                    <small>PNG, JPG jusqu'à 5MB</small>
                                </div>
                                <input type="file" id="profileImageInput" name="profileImage" accept="image/*" ">
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type=" submit" class="btn-submit" style="margin-top: 2rem;">S'inscrire</button>
                </form>

                <!-- Sign in link -->
                <div class="signup-link">
                    Vous avez déjà un compte ? <a href="login.html">Se connecter</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>