<h2 class="lettopclear">S'enregistrer</h2>
<hr/>
<form method="post" action="./?c=User&f=register" class="center">
    <label><h3>Login</h3></label>
    <input type="text" placeholder="Entrez le nom d'utilisateur" name="login" required>
    <label><h3>Pseudo</h3></label>
    <input type="text" placeholder="Entrez le nom à afficher" name="nickname">
    <label><h3>Mot de passe</h3></label>
    <input type="password" placeholder="Entrez le mot de passe" name="password" required>
    <label><h3>Répetez le mot de passe</h3></label>
    <input type="password" placeholder="Entrez de nouveau le mot de passe" name="password-verify" required>
    <?
        if (Conf::isCaptchaEnable()) {
            echo "<script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>";
            echo "<div class=\"g-recaptcha\" data-sitekey=\"" . Conf::getCaptchaPublicKey() . "\"></div>";
        }
    ?>
    <button type="submit" class="submit-btn">Créer</button>
</form>
