<?php
isset ( $_REQUEST['s'] ) ? $s = strip_tags($_REQUEST['s']) : $s = "";
isset ( $_REQUEST['sid'] ) ? $sid = strip_tags($_REQUEST['sid']) : $sid = "";
isset ( $_REQUEST['bid'] ) ? $bid = strip_tags($_REQUEST['bid']) : $bid = "";
isset ( $_REQUEST['cid'] ) ? $cid = strip_tags($_REQUEST['cid']) : $cid = "";
$sid=htmlspecialchars($sid);
$bid=htmlspecialchars($bid);
$cid=htmlspecialchars($cid);
$s=htmlspecialchars($s);
function connect($db){
        $mycnf="/etc/hw5-mysql.conf";
        if (!file_exists($mycnf)) {
                echo "Error file not found: $mycnf";
                exit;
        }
        $mysql_ini_array=parse_ini_file($mycnf);
        $db_host=$mysql_ini_array["host"];
        $db_user=$mysql_ini_array["user"];
        $db_pass=$mysql_ini_array["pass"];
        $db_port=$mysql_ini_array["port"];
        $db_name=$mysql_ini_array["dbName"];
        $db = mysqli_connect(
                $db_host,
                $db_user,
                $db_pass,
                $db_name,
                $db_port
        );
        if (!$db) {
                print "Error connecting to DB: " . mysqli_connect_error();
                exit;
        }
        return $db;
}

function icheck($i) { //Check for numeric
        if ($i != null) {
                if (!is_numeric($i)) {
                        print "<b> Error: </b> Invalid Syntax. ";
                        exit;
                }
        }
}

?>
