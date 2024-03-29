<script src='assets/js/bloc.js'></script>

<h1 id="bloc_name"><? echo htmlentities($var->getName()) ?></h1>
<h2><? echo htmlentities($var->getDifficulty()); ?></h2>
<h3>Ouvert part <a href="?c=User&f=see&login=<? echo htmlentities($var->getCreator()) ?>"><? echo htmlentities(UserUtils::getUser($var->getCreator())->getNickname()) ?></a> le <? echo htmlentities($var->getDate()) ?></h3>
<hr>
<h3><?
    $msg = "";
    foreach ($var->getTypes() as $type) {
        $msg = $msg . ", " . $type;
    }
    echo htmlentities(substr($msg, 2));
?></h3>
<h3><?
    $msg = "";
    foreach ($var->getZones() as $zones) {
        $msg = $msg . ", " . $zones;
    }
    echo htmlentities(substr($msg, 2));
?></h3>
<?
    $desc = $var->getDescription();
    if ($desc != NULL)
        echo "<p>" . htmlentities($desc) . "</p>";
?>
<?
    $images = array_reverse($var->getImagesPath());
    echo "<div id='main_canva' data-src='" . htmlentities($images[0]) . "' data-apiurl='" . Conf::getAPI() . "'></div><img src='" . $images[0] . "' alt='mainphoto' id='main_photo' hidden>";
?>
<div class="inline center responsive">
    <?
        if (sizeof($images) > 1) {
            for ($i = 1; $i < sizeof($images); $i++) {
                $image = $images[$i];
                echo "<img src='" . $image . "' alt='photo'/>";
            }
        }
    ?>
</div>