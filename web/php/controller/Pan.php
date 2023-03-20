<?php
    class Pan {
        static public function main() {
            ViewManager::callPan("home");
        }

        static public function create() {
            require_once("model/ModelBloc.php");
            if (UserUtils::askToConnectAndHasType("OUVREUR")) {
                if (array_key_exists("name", $_POST) && array_key_exists("dif", $_POST) && array_key_exists("images", $_FILES) && count($_FILES["images"]["name"]) > 0&& strlen($_FILES["images"]["name"][0]) > 0) {
                    if (ModelBloc::getByName($_POST["name"]) == false) {
                        if (array_key_exists("types", $_POST))
                            $types = $_POST["types"];
                        else
                            $types = [];
                        if (array_key_exists("zones", $_POST))
                            $zones = $_POST["zones"];
                        else
                            $zones = [];
                        if (array_key_exists("desc", $_POST) && strlen($_POST["desc"]) > 0)
                            $desc = $_POST["desc"];
                        else
                            $desc = NULL;
                        
                        $bloc = new ModelBloc($_POST["name"], $_POST["dif"], UserUtils::getLogin(), date("Y-m-d"), $types, $zones, $desc);
                        $bloc->updateImages($_FILES["images"]);
                        $bloc->save();
                        header("location: ?c=Pan&f=see&name=" . $bloc->getName());
                    } else
                        CustomError::call("Un bloc du même nom existe déjà");
                } else {
                    ViewManager::callPan("create");
                }
            } else
                CustomError::call("Tu dois être ouvreur pour pourvoir acceder à cette page, contact un administrateur pour obtenir le rôle");
        }

        static public function edit() {
            if (array_key_exists("name", $_GET)) {
                require_once("model/ModelBloc.php");
                $bloc = ModelBloc::getByName($_GET["name"]);
                if ($bloc != False)
                    if (UserUtils::isAdmin() || $bloc->getCreator())
                        ViewManager::callPan("edit", $bloc);
                    else
                        CustomError::call("Vous ne pouvez pas éditer ce bloc");
                else
                    CustomError::call("Le bloc n'existe pas");
            } else
                CustomError::call("Précisez un nom de bloc");
        } 

        static public function see() {
            if (UserUtils::isConnected())
                if (array_key_exists("name", $_GET)) {
                    require_once("model/ModelBloc.php");
                    $bloc = ModelBloc::getByName($_GET["name"]);
                    if ($bloc != False)
                        ViewManager::callPan("bloc", $bloc);
                    else
                        CustomError::call("Le bloc n'existe pas");
                } else
                    CustomError::call("Précisez un nom de bloc");
            else
                UserUtils::askToConnect()  ;              
        }

        static public function delete() {
            if (array_key_exists("name", $_GET)) {
                require_once("model/ModelBloc.php");
                $bloc = ModelBloc::getByName($_GET["name"]);
                if ($bloc != False) {
                    if (UserUtils::isAdmin() || UserUtils::getLogin() == $bloc->getCreator()) {
                        $bloc->delete();
                        ViewManager::callUser("home", $_SESSION["user_model"]);
                    } else
                        CustomError::call("Vous n'avez pas la permission de supprimer ce bloc");
                }
                else
                    CustomError::call("Le bloc n'existe pas");
            } else {
                CustomError::call("Précisez un nom de bloc");
            }
        }
    }