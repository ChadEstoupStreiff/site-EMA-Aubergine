<?
    class CustomError {
        public static function call($message = NULL) {
            CustomError::callError($message);
        }

        public static function callError($message = NULL) {
            if (!is_null($message))
                $ERROR = "Message: " . $message;
            else
                $ERROR = "Contactez l'Administrateur.";
            ViewManager::callGlobal("error", $ERROR);
            require_once('view/footer.php');
            die;
        }
    }

    class ViewManager {
        private static $has_header = false;

        public static function callMeme($view, $var=NULL) {
            ViewManager::callView("meme/" . $view, $var);
        }

        public static function callPan($view, $var=NULL) {
            ViewManager::callView("pan/" . $view, $var);
        }

        public static function callAdmin($view, $var=NULL) {
            ViewManager::callView("admin/" . $view, $var);
        }

        public static function callUser($view, $var=NULL) {
            ViewManager::callView("user/" . $view, $var);
        }

        public static function callGlobal($view, $var=NULL) {
            ViewManager::callView("global/" . $view, $var);
        }

        public static function callView($view, $var=NULL) {
            if (ViewManager::$has_header == false) {
                ViewManager::$has_header = true;
                require_once('view/header.php');
            }
            require("view/" . $view . ".php");
        }
    }
