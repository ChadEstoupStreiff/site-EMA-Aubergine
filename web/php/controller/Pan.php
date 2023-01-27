<?php
    class Pan {
        static public function main() {
            ViewManager::callPan("home");
        }

        static public function create() {
            if (UserUtils::askToConnectAndHasType("OUVREUR")) {
                if (array_key_exists("name", $_POST)) {
                    echo "todo";
                } else
                    ViewManager::callPan("create");
            } else
                CustomError::call("Tu dois être ouvreur pour pourvoir acceder à cette page, contact un administrateur pour obtenir le rôle");
        }
    }