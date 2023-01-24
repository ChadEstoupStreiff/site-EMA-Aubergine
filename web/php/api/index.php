<?
    function get_users() {
        $pageSize = array_key_exists("pageSize", $_GET) != null ? $_GET["pageSize"] : 10;
        $page = array_key_exists("page", $_GET) != null ? $_GET["page"] : 0;
        
        $sql = "SELECT login, nickname, type FROM User LIMIT " . $pageSize . " OFFSET " . $page * $pageSize;
        try {
            $req_prep = DBCom::getPDO()->prepare($sql);
            $req_prep->setFetchMode(PDO::FETCH_NUM);
            $req_prep->execute();
            $tabUtil = $req_prep->fetchAll();
            return json_encode($tabUtil);
        } catch (PDOException $e) {
            return "SQL Error: " . $e->getMessage();
        }
    }


    require_once("../utils/DBCom.php");

    if (sizeof($_GET) == 0) {
        echo "API ready";
    } else {
        if (array_key_exists("f", $_GET)) {
            if ($_GET["f"] == "users")
                print_r(get_users());
            else
                echo "Unknow parameter f";
        } else {
            echo "Missing f parameter";
        }
    }
?>