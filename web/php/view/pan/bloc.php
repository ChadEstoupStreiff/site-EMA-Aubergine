<h1><? echo $var->getName(); ?></h1>
<h2><? echo $var->getDif(); ?></h2>
<h3>Ouvert part <a href="?c=User&f=see&login=<? echo $var->getCreator() ?>"><? echo UserUtils::getUser($var->getCreator())->getNickname(); ?></a> le <? echo $var->getDate(); ?></h3>
<hr>
<h3><?
    $msg = "";
    foreach ($var->getTypes() as $type) {
        $msg = $msg . ", " . $type;
    }
    echo substr($msg, 2);
?></h3>
<?
    $desc = $var->getDesc();
    if ($desc != NULL)
        echo "<p>" . $desc . "</p>";
?>
<?
    $video = $var->getVideoPath();
    if ($video != NULL)
        echo '<video controls><source src="' . $video . '" type="video/mp4"> Sorry, your browser doesn t support embedded videos.</video>';
?>
<div class="inline center responsive">
    <?
        $images = $var->getImagesPath();
        foreach ($images as $image) {
            echo "<img src='" . $image . "' alt='photo'/>";
        }
    ?>
</div>
<img src="">