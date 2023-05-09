<?php
require_once('./model/Model.php');
class ModelUser implements  Model {

    static public function getListClass() {
        return ["Externe", "Ancien", "FIG1A", "FIG2A", "FIG3A", "FIA1A", "FIA2A", "FIA3A"];
    }

    private $type;
    private $login;
    private $nickname;
    private $password;
    private $email;
    private $phone;
    private $class;
    private $description;
    private $nivbloc;
    private $nivdif;
    private $show;

    public function __construct(
            $ty = NULL,
            $login = NULL,
            $nickname = NULL,
            $pwd = NULL,
            $email = NULL,
            $phone = NULL,
            $class = NULL,
            $description = NULL, 
            $nivbloc = NULL, 
            $nivdif = NULL, 
            $show = NULL) {
        $this->setType($ty);
        $this->setNickName($nickname);
        $this->setLogin($login);
        $this->setPassword($pwd);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setClass($class);
        $this->setDescription($description);
        $this->setNivBloc($nivbloc);
        $this->setNivDif($nivdif);
        $this->setShow($show);
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
            $sqlI = "INSERT INTO User (`type`, `login`, `nickname`, `password`, `email`, `phone`, `class`, `description`, `nivbloc`, `nivdif`, `show`) VALUES (:ty, :log, :nic, :pwd, :mail, :phone, :class, :de, :nbloc, :ndif, :sh)";
            try {
                $req_prep = DBCom::getPDO()->prepare($sqlI);
                $values = array(
                    "ty" => $this->gettype(),
                    "log" => $this->getLogin(),
                    "nic" => $this->getNickName(),
                    "pwd" => $this->getPassword(),
                    "mail" => $this->getEmail(),
                    "phone" => $this->getPhone(),
                    "class" => $this->getClass(),
                    "de" => $this->getDescription(),
                    "nbloc" => $this->getNivBloc(),
                    "ndif" => $this->getNivDif(),
                    "sh" => $this->show,
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        } else {
            $sql = "UPDATE User SET `type` = :ty, `nickname` = :nic, `password` = :pwd, `email` = :mail, `phone` = :phone, `class` = :class, `description` = :de, `nivbloc` = :nbloc, `nivdif` = :ndif, `show` = :sh WHERE `login` = :log";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "ty" => $this->gettype(),
                    "log" => $this->getLogin(),
                    "nic" => $this->getNickName(),
                    "pwd" => $this->getPassword(),
                    "mail" => $this->getEmail(),
                    "phone" => $this->getPhone(),
                    "class" => $this->getClass(),
                    "de" => $this->getDescription(),
                    "nbloc" => $this->getNivBloc(),
                    "ndif" => $this->getNivDif(),
                    "sh" => $this->show,
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
        $sql = "DELETE FROM User WHERE `login` = :login";
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
        $this->setEmail($UserRecovered->getEmail());
        $this->setPhone($UserRecovered->getPhone());
        $this->setClass($UserRecovered->getClass());
        $this->setDescription($UserRecovered->getDescription());
        $this->setNivBloc($UserRecovered->getNivBloc());
        $this->setNivDif($UserRecovered->getNivDif());
        $this->setShow($UserRecovered->isShowing());
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

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getClass() {
        return $this->class;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNivBloc() {
        return $this->nivbloc;
    }

    public function getNivDif() {
        return $this->nivdif;
    }

    public function isShowing() {
        return $this->show == 1;
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
                CustomError::callError("Le mot de passe ne doit pas dépasser les 60 caractères");
            }
        }
    }

    public function setEmail($email) {
        if (!is_null($email)) {
            if (strlen($email) <= 60) {
                $this->email = $email;
            } else {
                CustomError::callError("L'email ne doit pas dépasser les 60 caractères");
            }
        }
    }

    public function setPhone($phone) {
        if (!is_null($phone)) {
            if (strlen($phone) <= 20) {
                $this->phone = $phone;
            } else {
                CustomError::callError("Le téléphone ne doit pas dépasser les 20 caractères");
            }
        }
    }

    public function setClass($class) {
        if (!is_null($class)) {
            if (strlen($class) <= 10) {
                $this->class = $class;
            } else {
                CustomError::callError("La classe ne doit pas dépasser les 10 caractères");
            }
        }
    }

    public function setDescription($description) {
        if (!is_null($description)) {
            if (strlen($description) <= 512) {
                $this->description = $description;
            } else {
                CustomError::callError("La description ne doit pas dépasser les 512 caractères");
            }
        }
    }

    public function setNivBloc($nivbloc) {
        if (!is_null($nivbloc)) {
            if (strlen($nivbloc) <= 3) {
                $this->nivbloc = $nivbloc;
            } else {
                CustomError::callError("Le niveau difficulté ne doit pas dépasser les 3 caractères");
            }
        }
    }

    public function setNivDif($nivdif) {
        if (!is_null($nivdif)) {
            if (strlen($nivdif) <= 3) {
                $this->nivdif = $nivdif;
            } else {
                CustomError::callError("Le niveau bloc ne doit pas dépasser les 3 caractères");
            }
        }
    }

    public function setShow($show) {
        if (!is_null($show) && ($show == 0 || $show == 1)) {
            $this->show = $show;
        }
    }
}
