<h2>Changer de mot de passe</h2>
<form action="./?p=User&f=updatePassword" method="post">
    <div class="input-group">
        <label>Ancien mot de passe</label>
        <input type="password" name="oldpass" required>
    </div>
    <div class="input-group">
        <label>Nouveau mot de passe</label>
        <input type="password" name="newpass" required>
    </div>
    <div class="input-group">
        <label>Confirmation du mot de passe</label>
        <input type="password" name="confirmpass" required>
    </div>
    <div class="input-group">
        <input type="submit" class="button" value="Mettre à jour">
    </div>
</form>