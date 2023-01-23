<?php
require_once('./utils/DBCom.php');
interface Model {

    public static function getByID($id);
    public static function getByAttribute($attribute, $value);
    public static function getByAttributeAndCondition($attribute, $condition, $value);

    public static function getAll();
    public static function getAllByAttribute($attribute, $value);
    public static function getAllByAttributeAndCondition($attribute, $condition, $value);

    public static function deleteAll();
    public static function saveAll($tab);

    public function delete();
    public function save();
    //Récupére les informations de la base de données, et met à jour les attributs de l'objet en fonction du résultat.
    public function update();

}
