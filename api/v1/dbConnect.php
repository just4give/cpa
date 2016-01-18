<?php

class dbConnect {

    private $conn;
    private $pdodb;

    function __construct() { 
        
    }

 

    function connect(){
        try{
        include_once '../config.php'; 
        $dbhost   = DB_HOST;
        $dbuser   = DB_USERNAME;
        $dbpass   = DB_PASSWORD;
        $dbname   = DB_NAME;
        $dbmethod = 'mysql:';
        
        $dsn = $dbmethod. 'host='. $dbhost . ';dbname='  .$dbname;
        error_log($dsn . $dbuser . $dbpass  );
        $pdodb =  new PDO($dsn, $dbuser, $dbpass);
        $pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdodb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  
        return $pdodb; 
        }catch (Exception $e) {
            error_log( 'dbconect construct '. $e->getMessage());
        }
   
        
    }


}

?>
