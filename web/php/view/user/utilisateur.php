<h1>Utilisateur: <?php echo $_SESSION["login"]?></h1>
<h1>Type: <?php echo $_SESSION["type"]?></h1>
<div class="inline">
    <a class="button red" href="./?c=User&f=disconnect">Se déconnecter</a>
    <a class="button" href="./?c=User&f=passwordForm">Changer de mot de passe</a>
</div>
