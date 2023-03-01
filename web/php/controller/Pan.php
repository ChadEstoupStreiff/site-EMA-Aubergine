<?php
    class Pan {
        static public function main() {
            ViewManager::callPan("home");
        }

        static public function create() {
            if (UserUtils::askToConnectAndHasType("OUVREUR")) {
                if (array_key_exists("name", $_POST) && array_key_exists("dif", $_POST) && array_key_exists("images", $_FILES) && count($_FILES["images"]["name"]) > 0&& strlen($_FILES["images"]["name"][0]) > 0) {
                    require_once("model/ModelBloc.php");
                    if (ModelBloc::getByName($_POST["name"]) == false) {
                        if (array_key_exists("types", $_POST))
                            $types = $_POST["types"];
                        else
                            $types = [];
                        if (array_key_exists("desc", $_POST) && strlen($_POST["desc"]) > 0)
                            $desc = $_POST["desc"];
                        else
                            $desc = NULL;
                        if (array_key_exists("video", $_FILES) && strlen($_FILES["video"]["name"]) > 0)
                            $video = $_FILES["video"];
                        else
                            $video = NULL;
                        
                        $bloc = new ModelBloc($_POST["name"], $_POST["dif"], UserUtils::getLogin(), date("Y-m-d"), $types, $desc);
                        $bloc->updateImages($_FILES["images"]);
                        $bloc->updateVideo($_FILES["video"]);
                        $bloc->save();
                        header("location: ?c=Pan&f=see&name=" . $bloc->getName());
                    } else
                        CustomError::call("Un bloc du même nom existe déjà");
                } else
                    ViewManager::callPan("create");
            } else
                CustomError::call("Tu dois être ouvreur pour pourvoir acceder à cette page, contact un administrateur pour obtenir le rôle");
        }

        static public function see() {
            if (array_key_exists("name", $_GET)) {
                require_once("model/ModelBloc.php");
                $bloc = ModelBloc::getByName($_GET["name"]);
                ViewManager::callPan("bloc", $bloc);
            } else {
                CustomError::call("Précisez un nom de bloc");
            }
        }
    }