<?php
require_once('./model/Model.php');
class ModelUser implements  Model {

    private $id;
    private $type;
    private $login;
    private $password;

    public function __construct($id = NULL, $ty = NULL, $login = NULL, $pwd = NULL) {
        $this->setId($id);
        $this->setType($ty);
        $this->setLogin($login);
        $this->setPassword($pwd);
    }

    ################
    ##   STATIC   ##
    ################

    public static function getByID($id) {
        return self::getByAttribute('id', $id);
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
            $sql = "SELECT * FROM Utilisateur WHERE $attribut $condition :val";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "val" => $value);
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
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
        $sql = "SELECT * FROM Utilisateur";
        try {
            $req = DBCom::getPDO()->query($sql);
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
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
                if ($value instanceof ModelUtilisateur) {
                    $value->save();
                } else {
                    
                    CustomError::callError("Veuillez insérer un tableau d'Utilisateurs");
                }
            }
            return true;
        }
        return false;
    }

    public static function deleteAll() {
        $sql = "DELETE From Utilisateur";
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
        if (self::getByID($this->getId()) == false) {
            $sqlI = "INSERT INTO Utilisateur (type, login, password) VALUES (:ty, :log, :pwd)";
            try {
                $req_prep = DBCom::getPDO()->prepare($sqlI);
                $values = array(
                    "ty" => $this->type,
                    "log" => $this->login,
                    "pwd" => $this->password);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        } else {
            $sql = "UPDATE Utilisateur SET type = :ty, login = :log, password = :pwd WHERE id = :id";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "ty" => $this->type,
                    "log" => $this->login,
                    "pwd" => $this->password,
                    "id" => $this->id);
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        }
    }

    public function delete(){
        $sql = "DELETE FROM Utilisateur WHERE id = :id";
        try {
            $req_prep = DBCom::getPDO()->prepare($sql);
            $values = array("id" => $this->id);
            $req_prep->execute($values);
            return true;
        } catch(PDOException $e) {
            
            CustomError::callError($e->getMessage());
            return false;
        }
    }

    public function update() {
        $utilisateurRecovered = self::getByID($this->getId());
        $this->setType($utilisateurRecovered->getType());
        $this->setLogin($utilisateurRecovered->getLogin());
        $this->setPassword($utilisateurRecovered->getPassword());
    }

    ################
    ##   GETTER   ##
    ################

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
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

    public function setId($id) {
        if (!is_null($id)) {
            if ($id <= 1048576) {
                $this->id = $id;
            } else {
                CustomError::callError("La valeur de l'ID ne doit pas dépasser la valeur 1 048 576");
            }
        }
    }

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
