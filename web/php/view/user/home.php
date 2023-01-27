<h1>Bonjour <a><?php echo $var->getNickName()?></a> !</h1>

<hr/>

<h2>Utilisateur: <?php echo $var->getLogin()?></h2>
<h2>Type: <?php echo $var->getType()?></h2>
<div class="inline">
    <a class="button" href="./?c=User&f=informations">Changer ses informations</a>
    <a class="button" href="./?c=User&f=password">Changer de mot de passe</a>
</div>
<a class="button red" href="./?c=User&f=disconnect">Se déconnecter</a>

<?
if (UserUtils::hasType("OUVREUR")) {
    echo "<hr/><h1>Vous êtes ouvreur !</h1><a href='?&c=Pan&f=create' class='button'>Créer un bloc</a>";
}
?>