<?
    class UserUtils {
        public static function isConnected() {
            return array_key_exists('user_model', $_SESSION);
        }

        public static function hasType($type, $user = NULL) {
            if ($user == NULL)
                $user = UserUtils::getUser();
            return self::isConnected() && ($user->gettype() === $type || $user->gettype() === "ADMIN");
        }

        public static function isAdmin() {
            return self::isConnected() && UserUtils::getUser()->gettype() === "ADMIN";
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

        public static function getLogin()
        {
            return $_SESSION['user_model']->getLogin();
        }

        public static function getUser($login = NULL) {
            if ($login == NULL) {
                if (UserUtils::isConnected())
                    return $_SESSION["user_model"];
                else
                    return false;
            }
            return ModelUser::getByLogin($login);
        }
    }
    
