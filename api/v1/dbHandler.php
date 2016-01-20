<?php

class DbHandler {

    
    private $pdo;

    function __construct() {
        require_once 'dbConnect.php';
        // opening db connection
        $db = new dbConnect();
       
        $this->pdo = $db->connect();
    }
    /**
     * Fetching single record
     */
    public function getOneRecord($query) {
        //$r = $this->conn->query($query.' LIMIT 1') or die($this->conn->error.__LINE__);
        //return $result = $r->fetch_assoc();   
         $stmt = $this->pdo->query($query .' LIMIT 1');
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRecord($query) {
        $r = $this->pdo->exec($query);
        return $r;
    }
    /**
     * Creating new record
     */
    public function insertIntoTable($obj, $column_names, $table_name) {
        
        $c = (array) $obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach($column_names as $desired_key){ // Check the obj received. If blank insert blank into the array.
           if(!in_array($desired_key, $keys)) {
                $$desired_key = '';
            }else{
                $$desired_key = $c[$desired_key];
            }
            $columns = $columns.$desired_key.',';
            $values = $values."'".$$desired_key."',";
        }
        $query = "INSERT INTO ".$table_name."(".trim($columns,',').") VALUES(".trim($values,',').")";
        //$r = $this->conn->query($query) or die($this->conn->error.__LINE__);
         $r = $this->pdo->exec($query);

        if ($r) {
            
            return $this->pdo->lastInsertId();;
            } else {
            return NULL;
        }
    }
public function getSession(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['id']))
    {
        $sess["id"] = $_SESSION['id'];
        $sess["firstName"] = $_SESSION['firstName'];
        $sess["lastName"] = $_SESSION['lastName'];
        $sess["email"] = $_SESSION['email'];
        $sess["verified"] = $_SESSION['verified'];
    }
    else
    {
        $sess["id"] = '';
        
    }
    return $sess;
}
public function destroySession(){
    if (!isset($_SESSION)) {
    session_start();
    }
    if(isSet($_SESSION['id']))
    {
        unset($_SESSION['id']);
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['email']);
        $info='info';
        if(isSet($_COOKIE[$info]))
        {
            setcookie ($info, '', time() - $cookie_time);
        }
        $msg="Logged Out Successfully...";
    }
    else
    {
        $msg = "Not logged in...";
    }
    return $msg;
}
 
}

?>
