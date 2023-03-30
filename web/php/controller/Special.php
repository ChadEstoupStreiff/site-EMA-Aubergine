<?php
    class Special {
        static public function main() {
            ViewManager::callGlobal("home");
        }

        static public function rgpd() {
            ViewManager::callGlobal("rgpd");
        }
    }