<?
    function get_users() {
        $pageSize = array_key_exists("pageSize", $_GET) != null ? $_GET["pageSize"] : null;
        $page = array_key_exists("page", $_GET) != null ? $_GET["page"] : null;
        $regex = array_key_exists("regex", $_GET) != null ? $_GET["regex"] : null;

        
        if ((is_numeric($pageSize) || $pageSize == null) && (is_numeric($page) || $page == null)) {
            $sql = "SELECT login, nickname, type FROM User";
            $values = array();
            if ($regex != null) {
                $sql = $sql . " WHERE login LIKE :regex OR nickname LIKE :regex OR type LIKE :regex";
                $values["regex"] = "%" . $regex . "%";
            }
            if ($pageSize != null && $page != null)
                $sql = $sql . " LIMIT " . $pageSize . " OFFSET " . $page * $pageSize;
            
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $req_prep->setFetchMode(PDO::FETCH_NUM);
                $req_prep->execute($values);
                $tabUtil = $req_prep->fetchAll();
                return json_encode($tabUtil);
            } catch (PDOException $e) {
                return "SQL Error: " . $e->getMessage();
            }
        } else
            return "Parameter error";
        
    }
    
    function get_blocs() {
        $pageSize = array_key_exists("pageSize", $_GET) != null ? $_GET["pageSize"] : null;
        $page = array_key_exists("page", $_GET) != null ? $_GET["page"] : null;
        $regex = array_key_exists("regex", $_GET) != null ? $_GET["regex"] : null;

        
        if ((is_numeric($pageSize) || $pageSize == null) && (is_numeric($page) || $page == null)) {
            $sql = "SELECT name, dif, creator, date, types FROM Bloc";
            $values = array();
            if ($regex != null) {
                $sql = $sql . " WHERE name LIKE :regex OR creator LIKE :regex";
                $values["regex"] = "%" . $regex . "%";
            }
            if ($pageSize != null && $page != null)
                $sql = $sql . " LIMIT " . $pageSize . " OFFSET " . $page * $pageSize;
            
            try {
                $req_prep = DBCom::getPDO()->prepare($sql);
                $req_prep->setFetchMode(PDO::FETCH_NUM);
                $req_prep->execute($values);
                $tabUtil = $req_prep->fetchAll();
                return json_encode($tabUtil);
            } catch (PDOException $e) {
                return "SQL Error: " . $e->getMessage();
            }
        } else
            return "Parameter error";
        
    }


    require_once("../utils/DBCom.php");

    if (sizeof($_GET) == 0) {
        echo "API ready";
    } else {
        if (array_key_exists("f", $_GET)) {
            if ($_GET["f"] == "users")
                print_r(get_users());
            else if ($_GET["f"] == "blocs")
                print_r(get_blocs());
            else
                echo "Unknow parameter f";
        } else {
            echo "Missing f parameter";
        }
    }
?>