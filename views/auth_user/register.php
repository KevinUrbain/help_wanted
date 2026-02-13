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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Wanted - Inscription</title>
</head>

<body>
    <form action="" method="POST">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname"><br>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname"><br>

        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username"><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="street">Rue</label>
        <input type="text" name="street" id="street"><br>

        <label for="number_street">Numéro</label>
        <input type="text" name="number_street" id="number_street"><br>

        <label for="city">Ville</label>
        <input type="text" name="city" id="city"><br>

        <label for="zip_code">Code Postal</label>
        <input type="text" name="zip_code" id="zip_code"><br>

        <label for="phone_number">Numéro de téléphone</label>
        <input type="text" name="phone_number" id="phone_number"><br>

        <label for="profil">Votre profil</label>
        <textarea name="profil" id="profil"></textarea>

        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>