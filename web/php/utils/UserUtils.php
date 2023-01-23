<?
    require_once("model/ModelUser.php");
    class UserUtils {
        public static function isConnected() {
            return array_key_exists('type', $_SESSION);
        }

        public static function hasType($type) {
            return self::isConnected() && ($_SESSION["type"] === $type || $_SESSION["type"] === "ADMIN" || $_SESSION["type"] === "PROF");
        }

        public static function isAdmin() {
            return self::isConnected() && $_SESSION["type"] === "ADMIN";
        }


        public static function askToConnect($redirection = NULL) {
            if ($redirection != NULL)
                setcookie("redirection", $redirection, time()+3600); //1h
            header("location: ./?c=User&f=connect");
        }

        public static function askToConnectAndHasType($type, $redirection = NULL) {
            if (!self::isConnected()) {
                self::askToConnect($redirection);
            } else {
                return self::hasType($type);
            }
            return false;
        }

        public static function getId()
        {
            return $_SESSION['id'];
        }
    }
    
