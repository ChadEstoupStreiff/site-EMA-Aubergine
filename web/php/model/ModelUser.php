<?php
require_once('./model/Model.php');
class ModelUser implements  Model {

    private $type;
    private $login;
    private $nickname;
    private $password;

    public function __construct($ty = NULL, $login = NULL, $nickname = NULL, $pwd = NULL) {
        $this->setType($ty);
        $this->setNickName($nickname);
        $this->setLogin($login);
        $this->setPassword($pwd);
    }

    ################
    ##   STATIC   ##
    ################

    public static function getByLogin($login) {
        return self::getByAttribute('login', $login);
    }

    public static function getByAttribute($attribut, $value) {
        return self::getByAttributeAndCondition($attribut, '=', $value);
    }

    public static function getByAttributeAndCondition($attribut, $condition, $value){
        $tabUtil = self::getAllByAttributeAndCondition($attribut, $condition, $value);
        if ($tabUtil == false)
            return false;
        return $tabUtil[0];
    }

    public static function getAllByAttribute($attribut, $value) {
        return self::getAllByAttributeAndCondition($attribut, '=', $value);
    }

    public static function getAllByAttributeAndCondition($attribut, $condition, $value) {
        if(!is_null($attribut) && !is_null($condition) && !is_null($value)) {
            $sql = "SELECT * FROM User WHERE $attribut $condition :val";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "val" => $value);
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
                $tabUtil = $req_prep->fetchAll();
                if (empty($tabUtil))
                    return false;
                return $tabUtil;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        }
        return false;
    }

    public static function getAll() {
        $sql = "SELECT * FROM User";
        try {
            $req = DBCom::getPDO()->query($sql);
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $tabUtil = $req->fetchALL();
            if(empty($tabUtil))
                return false;
            return $tabUtil;
        } catch (PDOException $e) {
            
            CustomError::callError($e->getMessage());
            return false;
        }
    }

    public static function saveAll($tabUtil) {
        if (!empty($tabUtil)) {
            foreach ($tabUtil as $value) {
                if ($value instanceof ModelUser) {
                    $value->save();
                } else {
                    
                    CustomError::callError("Please insert a list of Users");
                }
            }
            return true;
        }
        return false;
    }

    public static function deleteAll() {
        $sql = "DELETE From User";
        try {
            DBCom::getPDO()->exec($sql);
            return true;
        } catch (PDOException $e) {
            
            CustomError::callError($e->getMessage());
            return false;
        }
    }

    ################
    ##   OBJECT   ##
    ################

    public function save() {
        if (self::getByLogin($this->getLogin()) == false) {
            $sqlI = "INSERT INTO User (type, login, nickname, password) VALUES (:ty, :log, :nic, :pwd)";
            try {
                $req_prep = DBCom::getPDO()->prepare($sqlI);
                $values = array(
                    "ty" => $this->type,
                    "log" => $this->login,
                    "nic" => $this->nickname,
                    "pwd" => $this->password
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        } else {
            $sql = "UPDATE User SET type = :ty, nickname = :nic, password = :pwd WHERE login = :log";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "ty" => $this->type,
                    "log" => $this->login,
                    "nic" => $this->nickname,
                    "pwd" => $this->password
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        }
    }

    public function delete(){
        $sql = "DELETE FROM User WHERE login = :login";
        try {
            $req_prep = DBCom::getPDO()->prepare($sql);
            $values = array("login" => $this->login);
            $req_prep->execute($values);
            return true;
        } catch(PDOException $e) {
            
            CustomError::callError($e->getMessage());
            return false;
        }
    }

    public function update() {
        $UserRecovered = self::getByLogin($this->getLogin());
        $this->setType($UserRecovered->getType());
        $this->setLogin($UserRecovered->getLogin());
        $this->setNickName($UserRecovered->getNickName());
        $this->setPassword($UserRecovered->getPassword());
    }

    ################
    ##   GETTER   ##
    ################

    public function getType() {
        return $this->type;
    }

    public function getNickName() {
        return $this->nickname;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }


    ################
    ##   SETTER   ##
    ################

    public function setType($ty) {
        if (!is_null($ty)) {
            if (strlen($ty) <= 8) {
                $this->type = $ty;
            } else {
                CustomError::callError("Le type de permission ne doit pas dépasser les 8 caractères");
            }
        }
    }

    public function setLogin($login) {
        if (!is_null($login)) {
            if (strlen($login) <= 32) {
                $this->login = $login;
            } else {
                CustomError::callError("Le nom ne doit pas dépasser les 32 caractères");
            }
        }
    }

    public function setNickName($nickname) {
        if (!is_null($nickname)) {
            if (strlen($nickname) <= 32) {
                $this->nickname = $nickname;
            } else {
                CustomError::callError("Le pseudo ne doit pas dépasser les 32 caractères");
            }
        }
    }

    public function setPassword($pwd) {
        if (!is_null($pwd)) {
            if (strlen($pwd) <= 60) {
                $this->password = $pwd;
            } else {
                CustomError::callError("Le mot de passe  ne doit pas dépasser les 60 caractères");
            }
        }
    }
}
