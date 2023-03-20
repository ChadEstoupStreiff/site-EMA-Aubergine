<h1><?php echo $var->getNickName()?></h1>
<p>Utilisateur: </p><h3><?php echo $var->getLogin()?></h3>
<p>Type: </p><h3><?php echo $var->getType()?></h3>
<hr/>
<p>Classe: </p><h3><?php echo $var->getClass()?></h3>
<p>E-Mail: </p><h3><? if ($var->isShowing() || UserUtils::isAdmin()) echo "<a href = 'mailto:" . $var->getEmail() . "'>" . $var->getEmail() . "</a>"; else echo "***" ?></h3>
<p>Téléphone: </p><h3><? if ($var->isShowing() || UserUtils::isAdmin()) echo "<a href = 'tel:" . $var->getPhone() . "'>" . $var->getPhone() . "</a>"; else echo "***" ?></h3>
<p>Niveau difficulté:</p>
<h3><? echo $var->getNivDif() ?></h3>
<p>Niveau bloc:</p>
<h3><? echo $var->getNivBloc() ?></h3>
<hr/>
<h3>Description:</h3>
<p><? echo $var->getDescription() ?></p>
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