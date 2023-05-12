<?
    require_once('./utils/DBCom.php');
    class Params {
        private static $_PARAMS = array();

        public static function getParam($key) {
            if (array_key_exists($key, Params::$_PARAMS))
                return Params::$_PARAMS[$key];
            $res = Params::getParamFromBDD($key);
            if ($res != NULL)
                Params::$_PARAMS[$key] = $res;
            return $res;
        }

        public static function setParam($key, $value) {
            Params::setParamToBDD($key, $value);
            Params::$_PARAMS[$key] = $value;
        }

        private static function getParamFromBDD($key) {
            $sql = "SELECT value FROM Params WHERE key_id = :keyid";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $req_prep->execute(array(
                    "keyid" => "$key"
                ));
                $req_prep->setFetchMode(PDO::FETCH_NUM);
                $tabUtil = $req_prep->fetch();
                if(empty($tabUtil))
                    return NULL;
                return $tabUtil[0];
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return NULL;
            }
        }

        private static function setParamToBDD($key, $value) {
            if (self::getParam($key) == NULL) {
                $sqlI = "INSERT INTO Params (`key_id`, `value`) VALUES (:keyid, :val)";
                try {
                    $req_prep = DBCom::getPDO()->prepare($sqlI);
                    $values = array(
                        "keyid" => $key,
                        "val" => $value,
                    );
                    $req_prep->execute($values);
                    return true;
                } catch (PDOException $e) {
                    CustomError::callError($e->getMessage());
                    return false;
                }
            } else {
                $sql = "UPDATE Params SET `value` = :val WHERE `key_id` = :keyid";
                try {
                    $req_prep = DBCom::getPDO()->prepare($sql);
                    $values = array(
                        "keyid" => $key,
                        "val" => $value,
                    );
                    $req_prep->execute($values);
                    return true;
                } catch (PDOException $e) {
                    CustomError::callError($e->getMessage());
                    return false;
                }
            }
        }
    }