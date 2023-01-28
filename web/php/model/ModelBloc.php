<?php
require_once('./model/Model.php');
class ModelBloc implements  Model {

    private $name;
    private $dif;
    private $creator;
    private $date;
    private $types;
    private $desc;
    private $images;
    private $video;

    public function __construct($name = NULL, $dif = NULL, $creator = NULL, $date = NULL, $types = NULL, $desc = NULL) {
        $this->setName($name);
        $this->setDif($dif);
        $this->setCreator($creator);
        $this->setDate($date);
        $this->setTypes($types);
        $this->setDesc($desc);
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
            $sqlI = "INSERT INTO `Bloc`(`name`, `dif`, `creator`, `date`, `types`, `desc`, `images`, `video`) VALUES (:name, :dif, :creator, :date, :types, :desc, :images, :video)";
            try {
                $req_prep = DBCom::getPDO()->prepare($sqlI);
                $values = array(
                    "name" => $this->name,
                    "dif" => $this->dif,
                    "creator" => $this->creator,
                    "date" => $this->date,
                    "types" => $this->types,
                    "desc" => $this->desc,
                    "images" => $this->images,
                    "video" => $this->video
                );
                $req_prep->execute($values);
                return true;
            } catch (PDOException $e) {
                CustomError::callError($e->getMessage());
                return false;
            }
        } else {
            $sql = "UPDATE `Bloc` SET `dif` = :dif, `creator` = :creator, `date` = :date, `types` = :types, `desc` = :desc, `images` = :images, `video` = :video WHERE `name` = :name";
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $values = array(
                    "name" => $this->name,
                    "dif" => $this->dif,
                    "creator" => $this->creator,
                    "date" => $this->date,
                    "types" => $this->types,
                    "desc" => $this->desc,
                    "images" => $this->images,
                    "video" => $this->video
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

    public function update() {
        $blocRecovered = self::getByName($this->getName());
        $this->setDif($blocRecovered->getDif());
        $this->setCreator($blocRecovered->getCreator());
        $this->setDate($blocRecovered->getDate());
        $this->setTypes($blocRecovered->getTypes());
        $this->setDesc($blocRecovered->getDesc());
    }

    ################
    ##   GETTER   ##
    ################

    public function getName() {
        return $this->name;
    }

    public function getDif() {
        return $this->dif;
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

    public function getDesc() {
        return $this->desc;
    }

    public function getImages() {
        return json_decode($this->images, true);
    }

    public function getVideo() {
        return $this->video;
    }

    public function getImagesPath() {
        $images = [];
        foreach (json_decode($this->images) as $f) {
            $images[] = "files/blocs/" . $this->name . "/images/" . $f;
        } 
        return $images;
    }

    public function getVideoPath() {
        if ($this->video == NULL)
            return NULL;
        return "files/blocs/" . $this->name . "/" . $this->video;
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

    public function setDif($dif) {
        if (!is_null($dif)) {
            if (strlen($dif) <= 32) {
                $this->dif = $dif;
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

    public function setDesc($desc) {
        if (!is_null($desc)) {
            if (strlen($desc) <= 256) {
                $this->desc = $desc;
            } else {
                CustomError::callError("La description ne doit pas dépasser les 256 caractères");
            }
        }
    }

    public function updateImages($images) {
        if (count($images["name"]) > 4) {
            CustomError::call("Tu ne peux pas upload plus de 4 images");
        } else {
            $folder = "files/blocs/" . $this->name . "/images/"; 
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

    public function updateVideo($video) {
        $folder = "files/blocs/" . $this->name . "/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        } else if ($this->video != NULL) {
            unlink($folder . $this->video);
        }

        if ($video != NULL) {
            $tmpFilePath = $video['tmp_name'];
            if ($tmpFilePath != "") {
                $fileExt = explode('.', $video['name']);
                $newName = uniqid('', true) . '.' . strtolower(end($fileExt));

                if (move_uploaded_file($tmpFilePath, $folder . $newName)) {
                    $this->video = $newName;
                }
            }
        }
    }
}
