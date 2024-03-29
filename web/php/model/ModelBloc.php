<?php
require_once('./model/Model.php');
class ModelBloc implements  Model {

    public static function getListDifficulties() {
        return ["4&-", "5", "6a", "6a+", "6b", "6b+", "6c", "6c+", "7a", "7a+", "7b", "7b+", "7c", "7c+", "8&+"];
    }

    public static function getListTypes() {
        return ["Force", "Technique", "Reglettes", "Morphologie", "Jetté", "Dalle", "Devert", "Surplomb", "Prou", "Japoneserie", "Grégoire (mutant)", "Dièdre", "Run & Jump & Skate"];
    }

    public static function getListZones() {
        return ["Porte gauche", "Porte droit", "devers gauche", "devers droit", "dalle gauche", "dalle droit", "devers fond droit", "dalle fond"];
    }

    private $name;
    private $difficulty;
    private $creator;
    private $date;
    private $types;
    private $zones;
    private $description;
    private $images;
    private $holds;

    public function __construct($name = NULL, $difficulty = NULL, $creator = NULL, $date = NULL, $types = NULL, $zones = NULL, $description = NULL, $holds = NULL) {
        $this->setName($name);
        $this->setDifficulty($difficulty);
        $this->setCreator($creator);
        $this->setDate($date);
        $this->setTypes($types);
        $this->setZones($zones);
        $this->setDescription($description);
        $this->setHolds($holds);
        if ($this->images == NULL)
            $this->images = "[]";
    }

    ################
    ##   STATIC   ##
    ################

    public static function getByName($name) {
        return self::getByAttribute('name', $name);
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
            $sql = "SELECT * FROM Bloc WHERE $attribut $condition :val";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "val" => $value);
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBloc');
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
        $sql = "SELECT * FROM Bloc";
        try {
            $req = DBCom::getPDO()->query($sql);
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelBloc');
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
                if ($value instanceof ModelBloc) {
                    $value->save();
                } else {
                    
                    CustomError::callError("Please insert a list of Blocs");
                }
            }
            return true;
        }
        return false;
    }

    public static function deleteAll() {
        $sql = "DELETE From Bloc";
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
        if (self::getByName($this->getName()) == false) {
            $sqlI = "INSERT INTO `Bloc`(`name`, `difficulty`, `creator`, `date`, `types`, `zones`, `description`, `images`, `holds`) VALUES (:name, :difficulty, :creator, :date, :types, :zones, :description, :images, :holds)";
            try {
                $req_prep = DBCom::getPDO()->prepare($sqlI);
                $values = array(
                    "name" => $this->name,
                    "difficulty" => $this->difficulty,
                    "creator" => $this->creator,
                    "date" => $this->date,
                    "types" => $this->types,
                    "zones" => $this->zones,
                    "description" => $this->description,
                    "images" => $this->images,
                    "holds" => $this->holds,
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        } else {
            $sql = "UPDATE `Bloc` SET `difficulty` = :difficulty, `creator` = :creator, `date` = :date, `types` = :types, `zones` = :zones, `description` = :description, `images` = :images, `holds` = :holds WHERE `name` = :name";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "name" => $this->name,
                    "difficulty" => $this->difficulty,
                    "creator" => $this->creator,
                    "date" => $this->date,
                    "types" => $this->types,
                    "zones" => $this->zones,
                    "description" => $this->description,
                    "holds" => $this->holds,
                    "images" => $this->images,
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
        $sql = "DELETE FROM Bloc WHERE name = :name";
        try {
            $req_prep = DBCom::getPDO()->prepare($sql);
            $values = array("name" => $this->getName());
            $req_prep->execute($values);
            return true;
        } catch(PDOException $e) {
            
            CustomError::callError($e->getMessage());
            return false;
        }
    }

    public function deleteFiles(){
        foreach ($this->getImages() as $img) {
            unlink("files/blocs/" . $this->name . "/" . $img);
        }
        rmdir("files/blocs/" . $this->name);
    }

    public function update() {
        $blocRecovered = self::getByName($this->getName());
        $this->setDifficulty($blocRecovered->getDifficulty());
        $this->setCreator($blocRecovered->getCreator());
        $this->setDate($blocRecovered->getDate());
        $this->setTypes($blocRecovered->getTypes());
        $this->setDescription($blocRecovered->getDescription());
        $this->setHolds($blocRecovered->getHolds());
    }

    ################
    ##   GETTER   ##
    ################

    public function getName() {
        return $this->name;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function getCreator() {
        return $this->creator;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTypes() {
        return json_decode($this->types, true);
    }

    public function getZones() {
        return json_decode($this->zones, true);
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImages() {
        return json_decode($this->images, true);
    }

    public function getHolds() {
        return json_decode($this->holds, true);
    }

    public function getImagesPath() {
        $images = [];
        foreach (json_decode($this->images) as $f) {
            $images[] = "files/blocs/" . $this->name . "/" . $f;
        } 
        return $images;
    }


    ################
    ##   SETTER   ##
    ################

    public function setName($name) {
        // TODO move files
        if (!is_null($name)) {
            if (strlen($name) <= 32) {
                $this->name = $name;
            } else {
                CustomError::callError("Le nom ne doit pas dépasser les 32 caractères");
            }
        }
    }

    public function setDifficulty($difficulty) {
        if (!is_null($difficulty)) {
            if (strlen($difficulty) <= 3) {
                $this->difficulty = $difficulty;
            } else {
                CustomError::callError("La difficulté ne doit pas dépasser les 3 caractères");
            }
        }
    }

    public function setCreator($creator) {
        if (!is_null($creator)) {
            $this->creator = $creator;
        }
    }

    public function setDate($date) {
        if (!is_null($date)) {
            $this->date = $date;
        }
    }

    public function setTypes($types) {
        if (!is_null($types)) {
            if (sizeof($types) <= 5) {
                $this->types = json_encode($types);
            } else {
                CustomError::callError("Un bloc ne peut pas dépasser les 5 types");
            }
        }
    }

    public function setZones($zones) {
        if (!is_null($zones)) {
            $this->zones = json_encode($zones);
        }
    }

    public function setHolds($holds) {
        if (!is_null($holds)) {
            $this->holds = json_encode($holds);
        }
    }


    public function setDescription($description) {
        if (!is_null($description)) {
            if (strlen($description) <= 1024) {
                $this->description = $description;
            } else {
                CustomError::callError("La description ne doit pas dépasser les 1024 caractères");
            }
        }
    }

    public function updateImages($images) {
        if (count($images["name"]) > 3) {
            CustomError::call("Tu ne peux pas upload plus de 3 images");
        } else {
            $folder = "files/blocs/" . $this->name . "/"; 
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            } else {
                foreach (json_decode($this->images) as $f) {
                    unlink($folder . $f);
                }
            }
            $new_images = [];
    
            for( $i=0 ; $i < count($images['name']) ; $i++ ) {
    
                $tmpFilePath = $images['tmp_name'][$i];
                if ($tmpFilePath != "") {
                    $fileExt = explode('.', $images['name'][$i]);
                    $newName = uniqid('', true) . '.' . strtolower(end($fileExt));
                    
                    if (move_uploaded_file($tmpFilePath, $folder . $newName)) {
                        $new_images[] = $newName;
                    }
                }
            }
    
            $this->images = json_encode($new_images);
        }
    }

    public function moveFilesTo($path) {
        rename("files/blocs/" . $this->name, $path);
    }
}
