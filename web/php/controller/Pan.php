<?php
    class Pan {
        static public function main() {
            ViewManager::callPan("home");
        }

        static public function create() {
            if (UserUtils::askToConnectAndHasType("OUVREUR")) {
                if (array_key_exists("name", $_POST) && array_key_exists("dif", $_POST) && array_key_exists("images", $_POST)) {
                    require_once("model/ModelBloc.php");
                    if (ModelBloc::getByName($_POST["name"]) == false) {
                        if (array_key_exists("types", $_GET))
                            $types = $_POST["types"];
                        else
                            $types = [];
                        if (array_key_exists("desc", $_GET))
                            $desc = $_POST["desc"];
                        else
                            $desc = NULL;
                        if (array_key_exists("video", $_GET))
                            $video = $_POST["video"];
                        else
                            $video = NULL;
                        
                        $bloc = new ModelBloc($_POST["name"], $_POST["dif"], UserUtils::getLogin(), date("Y-m-d"), $types, $desc);
                        $bloc->updateImages($_POST["images"]);
                        $bloc->updateVideo($video);
                        $bloc->save();
                        header("location: ?c=Pan&f=see&name=test");
                    } else
                        CustomError::call("Un bloc du même nom existe déjà");
                } else
                    ViewManager::callPan("create");
            } else
                CustomError::call("Tu dois être ouvreur pour pourvoir acceder à cette page, contact un administrateur pour obtenir le rôle");
        }
    }