<h1>Connexion</h1>
<hr />
<form action="./?c=User&f=connect" method="post" class="center">
    <label><h2>Utilisateur</h2></label>
    <input type="text" name="username" placeholder="Entrez votre nom d'utilisateur" <?php if (array_key_exists("login", $var)) echo "value=\"" . $var["login"] . "\""; ?> required>
    <label><h2>Mot de passe</h2></label>
    <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
    <input type="submit" class="button" value="Se connecter">
    <a href="?c=User&f=register">S'enregistrer</a>
</form>
