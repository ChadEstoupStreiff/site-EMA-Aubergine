<?
    class DBCom {
        # Instance du singleton
        private static $pdo = NULL;

        # Initialise le PDO
        public static function init() {
            require_once('config/DBConf.php');
            try{
                self::$pdo = new PDO(
                    "mysql:host=" . DBConf::getHostname() . ";dbname=" . DBConf::getDatabase(),
                    DBConf::getLogin(),
                    DBConf::getPassword(),
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                $_POST["error_message"] = "Erreur lors de la connection à la Base de Données: " . $e;

                $controller = '';
                $view = 'error';
                require('view/view.php');
                die();
            }
        }

        # Récupérer l'instance, la créé si elle existe
        public static function getPDO() {
            if (is_null(self::$pdo))
                self::init();
            return self::$pdo;
        }
    }
