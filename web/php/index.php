<?
// error_reporting(E_ERROR | E_PARSE);

require_once("model/ModelUser.php");
require_once("utils/UserUtils.php");
require_once("utils/ViewManager.php");
session_start();

if (sizeof($_GET) > 0 && array_key_exists("c", $_GET)) {
    $c = $_GET["c"];

    if (file_exists("controller/" . $c . ".php")) {
        require_once("controller/" . $c . ".php");

        if (array_key_exists("f", $_GET)) {
            $f = $_GET["f"];
            if (method_exists($c, $f))
                $c::$f();
            else
                CustomError::callError("La fonction " . $f . " du controlleur " . $c . " n'existe pas");
        } else
            $c::main();
    } else
        CustomError::callError("Le controlleur " . $c . " n'existe pas");
} else
    ViewManager::callGlobal("home");
require_once('view/footer.php');
