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
            $login = $password = "";
            $username_err = $password_err = $login_err = "";

            // Processing form data when form is submitted

            // Check if username is empty
            if (!array_key_exists("username", $_POST)) {
                $username_err = "Please enter username.";
            } else {
                $login = $_POST["username"];
            }

            // Check if password is empty
            if (!array_key_exists("username", $_POST)) {
                $password_err = "Please enter your password.";
            } else {
                $password = $_POST["password"];
            }

            // Validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT id, type, login, password FROM Utilisateur WHERE login = :username";

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
                                $id = $row["id"];
                                $login = $row["login"];
                                $hashed_password = $row["password"];
                                $type = $row["type"];
                                if (password_verify($password, $hashed_password)) {

                                    $_SESSION["id"] = $id;
                                    $_SESSION["type"] = $type;
                                    $_SESSION["login"] = $login;

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
                        ViewManager::callUser('connect');

                    // Close statement
                    unset($stmt);
                }
            } else
                ViewManager::callUser('connect');
        }

        public static function accueilAdmin(){
            if(UserUtils::askToConnectAndHasType("ADMIN")){
                ViewManager::callUser('accueilAdmin');
            }
            else{
                CustomError::callError("You can't access to this content");
            }
        }

        public static function created(){
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (($_POST["type"] == "PROF" || $_POST["type"] == "ADMIN") && !UserUtils::isAdmin()) {
                    CustomError::callError("You can't access to this content");
                }
                $user = new ModelUtilisateur(null, $_POST["type"], $_POST["login"], password_hash($_POST["mdp"],PASSWORD_BCRYPT ));
                $user->save();
                header('location: ./?c=Administrateur');
            }
            else{
                CustomError::callError("You can't access to this content");
            }
        }

        public static function createdList() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (($_POST["type"] == "PROF" || $_POST["type"] == "ADMIN") && !UserUtils::isAdmin()) {
                    CustomError::callError("You can't access to this content");
                }
                $map = array();
                $tab = explode(',', $_POST['list']);
                $type = $_POST["type"];

                foreach ($tab as $loginClair) {
                    $array = str_replace(' ', '', explode("@", $loginClair)[0]);
                    $array = explode('.', $array);
                    $login = end($array) . $array[0][0];
                    $pass = User::generateRandomString();

                    $user = new ModelUtilisateur(null, $type, $login, password_hash($pass, PASSWORD_BCRYPT));
                    $user->save();

                    $map[$login] = $pass;
                }

                ViewManager::callAdmin('newUserList');
            }
            else{
                CustomError::callError("You can't access to this content");
            }
        }

        public static function delete() {
            if(UserUtils::askToConnectAndHasType("ADMIN")) {
                if (array_key_exists('id', $_GET)) {
                    $user = ModelUtilisateur::getByID($_GET['id']);
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
                    $user = ModelUtilisateur::getByID($_GET['id']);
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
            $user = ModelUtilisateur::getByID(UserUtils::getId());
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
