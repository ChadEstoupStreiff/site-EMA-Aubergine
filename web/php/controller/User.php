<?php
    class User {
        public static function disconnect() {
            if(UserUtils::isConnected()){
                $_SESSION = array();
                session_destroy();
            }
            UserUtils::askToConnect();
        }

        public static function connect()
        {
            if (array_key_exists("login", $_POST) && array_key_exists("password", $_POST)) {
                require_once "utils/ReCaptcha.php";
                if (!Conf::isCaptchaEnable() || ReCaptchaUtils::checkValid()) {
                    $user = UserUtils::getUser($_POST["login"]);
                    if ($user != false) {
                        $hashed_password = $user->getPassword();
                        if (password_verify($_POST["password"], $hashed_password)) {
                            $_SESSION["user_model"] = $user;
        
                            if (array_key_exists("redirection", $_COOKIE))
                                header("location: " . $_COOKIE['redirection']);
                            else
                                User::main();
                        } else
                            CustomError::callError("Incorrect password");
                    } else
                        CustomError::callError("User does not exists");   
                } else
                    CustomError::callError("Captcha invalid");
            } else
                ViewManager::callUser('connect');
        }

        public static function register() {
            
            if (array_key_exists("login", $_POST) && array_key_exists("password", $_POST) && array_key_exists("password-verify", $_POST)) {
                require_once "utils/ReCaptcha.php";
                if (!Conf::isCaptchaEnable() || ReCaptchaUtils::checkValid()) {
                    $nickname = "";
                    if (array_key_exists("nickname", $_POST))
                        $nickname = $_POST["nickname"];
                    else
                        $nickname = $_POST["login"];
                    if (strcmp($_POST['password'], $_POST['password-verify']) == 0) {
                        $user = new ModelUser("GUEST", $_POST["login"], $nickname, password_hash($_POST["password"],PASSWORD_BCRYPT ));
                        $user->save();
                        User::disconnect();
                        header('location: ./?c=User');
                    } else
                        CustomError::callError("Les mots de passe ne sont pas égaux");
                } else
                    CustomError::callError("Captcha invalid");
            } else
                ViewManager::callUser("register");
        }

        public static function password() {
            if(UserUtils::isConnected()){
                if (array_key_exists("oldpass", $_POST) && array_key_exists("newpass", $_POST) && array_key_exists("confirmpass", $_POST)) {
                    $user = ModelUser::getByLogin(UserUtils::getLogin());
                    if (password_verify($_POST['oldpass'] , $user->getPassword())) {
                        if (strcmp($_POST['newpass'], $_POST['confirmpass']) == 0) {
                            $user->setPassword(password_hash($_POST['newpass'],PASSWORD_BCRYPT));
                            $user->save();
                            User::disconnect();
                        } else
                            CustomError::callError("Passwords are not equals");
                    } else
                        CustomError::callError("Old password incorrect");
                } else
                    ViewManager::callUser('passwordForm');
            } else
                UserUtils::askToConnect();
        }

        public static function informations() {
            if(UserUtils::isConnected()){
                if (array_key_exists("nickname", $_POST)) {
                    $user = UserUtils::getUser();
                    $user->setNickName($_POST["nickname"]);
                    $user->save();
                    header("location: ./?c=User");
                } else {
                    $var = $_SESSION["user_model"];
                    ViewManager::callUser('infoForm', $var);
                }
            } else
                UserUtils::askToConnect();
        }

        public static function main()
        {
            if(UserUtils::isConnected()){
                $var = $_SESSION["user_model"];
                ViewManager::callUser('home', $var);
            } else
                UserUtils::askToConnect();
        }
    }
