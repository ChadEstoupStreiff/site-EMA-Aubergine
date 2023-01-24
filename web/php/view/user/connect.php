<script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>

<h1>Connexion</h1>
<hr />
<form action="./?c=User&f=connect" method="post" class="center">
    <label><h2>Utilisateur</h2></label>
    <input type="text" name="login" placeholder="Entrez votre nom d'utilisateur" required>
    <label><h2>Mot de passe</h2></label>
    <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
    <?
        if (Conf::isCaptchaEnable())
            echo "<div class=\"g-recaptcha\" data-sitekey=\"" . Conf::getCaptchaPublicKey() . "\"></div>"
    ?>
    <input type="submit" class="button" value="Se connecter">
    <a href="?c=User&f=register">S'enregistrer</a>
</form>
