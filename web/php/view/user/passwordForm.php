<h1>Changer de mot de passe</h1>
<hr/>
<form action="./?c=User&f=password" method="post" class="center">
        <label><h2>Ancien mot de passe</h2></label>
        <input type="password" name="oldpass" required>
        <label><h2>Nouveau mot de passe</h2></label>
        <input type="password" name="newpass" required>
        <label><h2>Confirmation du mot de passe</h2></label>
        <input type="password" name="confirmpass" required>
        <input type="submit" class="button" value="Mettre à jour">
</form>