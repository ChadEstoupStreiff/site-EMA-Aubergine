<?php
if(!empty($login_err)){
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}
?>
<div class="connect-container">
    <h1>Connexion</h1>
    <hr />
    <div class="connect-form">
        <form action="./?p=User&f=connect" method="post">
            <div class="field">
                <label>Pseudo</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="field">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="field">
                <input type="submit" class="button" value="Login">
            </div>
        </form>
    </div>
</div>
