function validateForm() {
    var username = document.getElementById("username").value;
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Vérification du mot de passe côté client
    if (!/(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&!])[A-Za-z\d@#$%^&!]{12,}/.test(password)) {
        alert("Le mot de passe doit contenir au moins 1 majuscule, 1 caractère spécial, 1 chiffre et 12 caractères.");
        return false;
    }

    // Vérification de l'email côté client
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        alert("Adresse e-mail invalide.");
        return false;
    }

    // Vérification du nom côté client
    if (!/^[A-Za-z]{1,32}$/.test(nom)) {
        alert("Nom invalide (maximum 32 caractères alphabétiques autorisés).");
        return false;
    }

    // Vérification du prénom côté client
    if (!/^[A-Za-z]{1,32}$/.test(prenom)) {
        alert("Prénom invalide (maximum 32 caractères alphabétiques autorisés).");
        return false;
    }

    // Vérification de l'username côté client
    if (!/^[A-Za-z0-9_]{1,32}$/.test(username)) {
        alert("Nom d'utilisateur invalide (maximum 32 caractères alphanumériques autorisés, y compris les soulignements _).");
        return false;
    }
    return true;
}
