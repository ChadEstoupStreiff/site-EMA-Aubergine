<h2>Bonjour <a href="?c=User&f=see&login=<? echo $var->getLogin() ?>"><?php echo $var->getNickName()?></a> !</h2>

<hr/>

<h3>Utilisateur: <?php echo $var->getLogin()?></h3>
<h3>Type: <?php echo $var->getType()?></h3>
<div class="inline">
    <a class="button" href="./?c=User&f=informations">Changer ses informations</a>
    <a class="button" href="./?c=User&f=password">Changer de mot de passe</a>
</div>
<a class="button red" href="./?c=User&f=disconnect">Se déconnecter</a>

<?
if (UserUtils::hasType("OUVREUR")) {
    echo "<hr/><h2>Vous êtes ouvreur !</h2><a href='?&c=Pan&f=create' class='button'>Créer un bloc</a>";
}
?>