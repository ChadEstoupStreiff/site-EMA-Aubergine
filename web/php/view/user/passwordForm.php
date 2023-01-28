<h2>Changer de mot de passe</h2>
<hr/>
<form action="./?c=User&f=password" method="post" class="center">
        <label><h3>Ancien mot de passe</h3></label>
        <input type="password" name="oldpass" required>
        <label><h3>Nouveau mot de passe</h3></label>
        <input type="password" name="newpass" required>
        <label><h3>Confirmation du mot de passe</h3></label>
        <input type="password" name="confirmpass" required>
        <input type="submit" class="button" value="Mettre à jour">
</form>