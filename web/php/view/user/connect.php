<h2>Connexion</h2>
<hr />
<form action="./?c=User&f=connect" method="post" class="center">
    <label><h3>Utilisateur</h3></label>
    <input type="text" name="login" placeholder="Entrez votre nom d'utilisateur" required>
    <label><h3>Mot de passe</h3></label>
    <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
    <?
        if (Conf::isCaptchaEnable()) {
            echo "<script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>";
            echo "<div class=\"g-recaptcha\" data-sitekey=\"" . Conf::getCaptchaPublicKey() . "\"></div>";
        }
    ?>
    <input type="submit" class="button" value="Se connecter">
    <a href="?c=User&f=register">S'enregistrer</a>
</form>
