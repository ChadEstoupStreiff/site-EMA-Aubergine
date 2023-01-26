<h1 class="lettopclear">S'enregistrer</h1>
<hr/>
<form method="post" action="./?c=User&f=register" class="center">
    <label><h2>Login</h2></label>
    <input type="text" placeholder="Entrez le nom d'utilisateur" name="login" required>
    <label><h2>Pseudo</h2></label>
    <input type="text" placeholder="Entrez le nom à afficher" name="nickname">
    <label><h2>Mot de passe</h2></label>
    <input type="password" placeholder="Entrez le mot de passe" name="password" required>
    <label><h2>Répetez le mot de passe</h2></label>
    <input type="password" placeholder="Entrez de nouveau le mot de passe" name="password-verify" required>
    <?
        if (Conf::isCaptchaEnable()) {
            echo "<script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>";
            echo "<div class=\"g-recaptcha\" data-sitekey=\"" . Conf::getCaptchaPublicKey() . "\"></div>";
        }
    ?>
    <button type="submit" class="submit-btn">Créer</button>
</form>
