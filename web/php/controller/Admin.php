<?php
    class Admin {
        public static function deleteUser() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('login', $_GET)) {
                    $user = ModelUser::getByLogin($_GET['login']);
                    if ($user != false) {
                        if ($user->getType() != "ADMIN" && $user->getLogin() != "admin") {
                            $user->delete();
                            header('location: ./?c=Admin');
                        } else
                            CustomError::callError("Admin user can't be deleted");
                    } else
                        CustomError::callError("No user with this login");
                } else
                    CustomError::callError("Define an login");
            }
            else
                CustomError::callError("You can't access to this content");
        }

        public static function regeneratepassword() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('login', $_GET)) {
                    $user = ModelUser::getByLogin($_GET['login']);
                    if ($user != false) {
                        if ($user->getLogin() != "admin") {
                            if ($user->getType() != "ADMIN" || UserUtils::getUser()->getLogin() == "admin") {

                                $passwordClair = Admin::generateRandomString();
                                $user->setPassword(password_hash($passwordClair,PASSWORD_BCRYPT));
                                $user->save();
    
                                ViewManager::callUser('newPass', $passwordClair);
                            } else
                                CustomError::callError("Only super admin user can't regenerate password of admin user");
                        } else
                            CustomError::callError("Can't regenerate super admin password");
                    } else
                        CustomError::callError("No user with this login");
                } else
                    CustomError::callError("Define an login");
            }
            else
                CustomError::callError("You can't access to this content");
        }

        private static function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public static function setUserType() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('login', $_GET) && array_key_exists('type', $_GET)) {
                    $user = ModelUser::getByLogin($_GET['login']);
                    if ($user != false) {
                        if ($user->getLogin() != "admin") {
                            if ($user->getType() != "ADMIN" || UserUtils::getUser()->getLogin() == "admin") {

                                $user->setType($_GET["type"]);
                                $user->save();
    
                                header('location: ./?c=Admin');
                            } else
                                CustomError::callError("Only super admin user can't set type of admin user");
                        } else
                            CustomError::callError("Can't set super admin type");
                    } else
                        CustomError::callError("No user with this login");
                } else
                    CustomError::callError("Define an login and a new type");
            }
            else
                CustomError::callError("You can't access to this content");
        }

        public static function users() {
            if (UserUtils::askToConnectAndHasType("ADMIN")) {
                ViewManager::callAdmin('users');
            } else
                CustomError::callError("You can't access to this content");
        }

        public static function blocs() {
            if (UserUtils::askToConnectAndHasType("ADMIN")) {
                ViewManager::callAdmin('blocs');
            } else
                CustomError::callError("You can't access to this content");
        }

        public static function main()
        {
            if (UserUtils::askToConnectAndHasType("ADMIN")) {
                ViewManager::callAdmin('home');
            }
        }

        public static function params()
        {
            if (UserUtils::askToConnectAndHasType("ADMIN")) {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        Params::setParam($key, $value);
                    }
                    if (array_key_exists("img_CAPI1", $_FILES) && strlen($_FILES["img_CAPI1"]["name"]) > 0) {
                        $tmpFilePath = $_FILES["img_CAPI1"]['tmp_name'];
                        unlink("assets/img/CAPI1.png");
                        if ($tmpFilePath != "")
                            move_uploaded_file($tmpFilePath, "assets/img/CAPI1.png");
                    }
                    if (array_key_exists("img_CAPI1", $_FILES) && strlen($_FILES["img_CAPI2"]["name"]) > 0) {
                        $tmpFilePath = $_FILES["img_CAPI2"]['tmp_name'];
                        unlink("assets/img/CAPI2.png");
                        if ($tmpFilePath != "")
                            move_uploaded_file($tmpFilePath, "assets/img/CAPI2.png");
                    }
                    header('location: ./?c=Admin');
                } else
                    ViewManager::callAdmin('params');
            }
        }
    }
