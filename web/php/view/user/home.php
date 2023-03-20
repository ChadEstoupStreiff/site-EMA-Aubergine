<h2>Bonjour <a href="?c=User&f=see&login=<? echo $var->getLogin() ?>"><?php echo $var->getNickName()?></a> !</h2>

<hr/>

<h3>Utilisateur: <?php echo $var->getLogin()?></h3>
<h3>Type: <?php echo $var->getType()?></h3>
<div class="inline">
    <a class="button" href="./?c=User&f=informations">Changer ses informations</a>
    <a class="button" href="./?c=User&f=see&login=<? echo UserUtils::getLogin() ?>">Voir mon profil</a>
</div>
<div class="inline">
    <a class="button" href="./?c=User&f=password">Changer de mot de passe</a>
    <a class="button red" href="./?c=User&f=disconnect">Se déconnecter</a>
</div>
<?
if (UserUtils::hasType("OUVREUR")) {
    echo "
    <hr/>
    <h2>Vous êtes ouvreur !</h2>
    <a href='?&c=Pan&f=create' class='button'>Créer un bloc</a>";
    echo "
    <link rel='stylesheet' href='assets/css/tab.css' type='text/css'>
    <script src='assets/js/table/Tab.js'></script>
    <script src='assets/js/table/actions/bloc_full.js'></script>
    <script src='assets/js/table/loaders/tab_blocs.js'></script>
    
    <div id='tab-blocs'>" . Conf::getAPI() . "/user/" . UserUtils::getLogin() . "/blocs</div>";
}
?>