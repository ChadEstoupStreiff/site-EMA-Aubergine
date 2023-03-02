<h2><?php echo $var->getNickName()?></h2>
<h3>Utilisateur: <?php echo $var->getLogin()?></h3>
<h3>Type: <?php echo $var->getType()?></h3>

<?
if (UserUtils::hasType("OUVREUR")) {
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