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
            // Include config file
            require_once("utils/DBCom.php");

            // Define variables and initialize with empty values
            $var = array();

            // Processing form data when form is submitted

            // Check if username is empty
            if (!array_key_exists("username", $_POST)) {
                $username_err = "Please enter username.";
            } else {
                $var["login"] = $_POST["username"];
            }

            // Check if password is empty
            if (array_key_exists("password", $_POST)) {
                $var["password"] = $_POST["password"];
            }

            // Validate credentials
            if (array_key_exists("login", $var) && array_key_exists("password", $var)) {
                // Prepare a select statement
                $sql = "SELECT type, login, password FROM User WHERE login = :username";

                if ($stmt = DBCom::getPDO()->prepare($sql)) {

                    // Set parameters
                    $param_username = $_POST["username"];

                    // Attempt to execute the prepared statement
                    if ($stmt->execute(array(
                        "username" => $param_username
                    ))) {
                        // Check if username exists, if yes then verify password
                        if ($stmt->rowCount() == 1) {
                            if ($row = $stmt->fetch()) {
                                $var["login"] = $row["login"];
                                $hashed_password = $row["password"];
                                $type = $row["type"];
                                if (password_verify($var["password"], $hashed_password)) {
                                    $_SESSION["type"] = $type;
                                    $_SESSION["login"] = $var["login"];

                                    if (array_key_exists("redirection", $_COOKIE))
                                        header("location: " . $_COOKIE['redirection']);
                                    else
                                        User::main();
                                } else
                                    CustomError::callError("Incorrect password");
                            }
                        } else
                            CustomError::callError("This account does not exists");
                    } else
                        ViewManager::callUser('connect', $var);

                    // Close statement
                    unset($stmt);
                }
            } else
                ViewManager::callUser('connect', $var);
        }

        public static function accueilAdmin(){
            if(UserUtils::askToConnectAndHasType("ADMIN")){
                ViewManager::callUser('accueilAdmin');
            }
            else{
                CustomError::callError("You can't access to this content");
            }
        }

        public static function register() {
            
            if (array_key_exists("login", $_POST) && array_key_exists("password", $_POST) && array_key_exists("password-verify", $_POST)) {
                if (strcmp($_POST['password'], $_POST['password-verify']) == 0) {
                    $user = new ModelUser("GUEST", $_POST["login"], password_hash($_POST["password"],PASSWORD_BCRYPT ));
                    $user->save();
                    User::disconnect();
                    header('location: ./?c=User');
                } else {
                    CustomError::callError("Les mots de passe ne sont pas égaux");
                }
            } else {
                ViewManager::callUser("register");
            }
        }

        public static function delete() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('id', $_GET)) {
                    $user = ModelUser::getByID($_GET['id']);
                    if ($user != false) {
                        if (($user->getType() == "PROF" || $user->getType() == "ADMIN") && !UserUtils::isAdmin()) {
                            CustomError::callError("You can't access to this content");
                        }
                        $user->delete();
                        header('location: ./?c=Administrateur');
                    } else {
                        CustomError::callError("No user with this ID");
                    }
                } else {
                    CustomError::callError("Define an ID");
                }
            }
            else{
                CustomError::callError("You can't access to this content");
            }
        }

        public static function regeneratepassword() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('id', $_GET)) {
                    $user = ModelUser::getByID($_GET['id']);
                    if ($user != false) {
                        if (($user->getType() == "PROF" || $user->getType() == "ADMIN") && !UserUtils::isAdmin()) {
                            CustomError::callError("You can't access to this content");
                        }

                        $passwordClair = User::generateRandomString();
                        $user->setPassword(password_hash($passwordClair,PASSWORD_BCRYPT));
                        $user->save();

                        ViewManager::callUser('newPass');
                    } else {
                        CustomError::callError("No user with this ID");
                    }
                } else {
                    CustomError::callError("Define an ID");
                }
            }
            else{
                CustomError::callError("You can't access to this content");
            }
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

        public static function passwordForm() {
            ViewManager::callUser('passwordForm');
        }

        public static function updatePassword() {
            $user = ModelUser::getByID(UserUtils::getId());
            if (password_verify($_POST['oldpass'] , $user->getPassword())) {
                if (strcmp($_POST['newpass'], $_POST['confirmpass']) == 0) {
                    $user->setPassword(password_hash($_POST['newpass'],PASSWORD_BCRYPT));
                    $user->save();
                    User::disconnect();
                } else {
                    CustomError::callError("Passwords are not equals");
                }
            } else {
                CustomError::callError("Old password incorrect");
            }
        }

        public static function main()
        {
            
            if(UserUtils::isConnected()){
                ViewManager::callUser('utilisateur');
            } else {
                UserUtils::askToConnect();
            }
        }
    }
