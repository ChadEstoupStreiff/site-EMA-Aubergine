<!-- <?
    if (UserUtils::hasType("OUVREUR")) {
        echo "<h2>Vous êtes ouvreur !</h2><a href='?&c=Pan&f=create' class='button'>Créer un bloc</a><hr/>";
    }
?> -->


<link rel="stylesheet" href="assets/css/tab.css" type="text/css">
<script src='assets/js/table/Tab.js'></script>
<script src='assets/js/table/actions/bloc_see.js'></script>
<script src='assets/js/table/loaders/tab_blocs.js'></script>

<div id="tab-blocs"><? echo Conf::getAPI() ?>/blocs</div>