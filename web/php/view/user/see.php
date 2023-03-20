<h1><?php echo $var->getNickName()?></h1>
<h3>Utilisateur: <?php echo $var->getLogin()?></h3>
<h3>Type: <?php echo $var->getType()?></h3>
<hr/>
<h3>Classe: <?php echo $var->getClass()?></h3>
<h3>E-Mail: <? if ($var->isShowing() || UserUtils::isAdmin()) echo "<a href = 'mailto:" . $var->getEmail() . "'>" . $var->getEmail() . "</a>"; else echo "***" ?></h3>
<h3>Téléphone: <? if ($var->isShowing() || UserUtils::isAdmin()) echo "<a href = 'tel:" . $var->getPhone() . "'>" . $var->getPhone() . "</a>"; else echo "***" ?></h3>
<hr/>
<h3>Niveau difficulté: <? echo $var->getNivDif() ?></h3>
<h3>Niveau bloc: <? echo $var->getNivBloc() ?></h3>
<h3>Description: <? echo $var->getDescription() ?></h3>
<?
if (UserUtils::hasType("OUVREUR", UserUtils::getUser($var->getLogin()))) {
    echo "
    <hr/>
    <h3>Ses blocs</h3>
    <link rel='stylesheet' href='assets/css/tab.css' type='text/css'>
    <script src='assets/js/table/Tab.js'></script>
    <script src='assets/js/table/actions/bloc_see.js'></script>
    <script src='assets/js/table/loaders/tab_blocs.js'></script>
    
    <div id='tab-blocs'>" . Conf::getAPI() . "/user/" . $var->getLogin() . "/blocs</div>";
}
?>