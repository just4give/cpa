<?php 
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    
    echoResponse(200, $session);
});

$app->post('/login', function() use ($app) {
    try{
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'password'),$r);
    $response = array();
    $db = new DbHandler();
    $password = $r->password;
    $email = $r->email;
    $user = $db->getOneRecord("select id,firstName,lastName,password,email from users where email='$email'");
    if ($user != NULL) {
        

        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['firstName'] = $user['firstName'];
        $response['lastName'] = $user['lastName'];
        $response['id'] = $user['id'];
        $response['email'] = $user['email'];
        
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
        }
    echoResponse(200, $response);
     }catch (Exception $e) {
                error_log( 'login  '. $e->getMessage());
     }
});
$app->post('/signUp', function() use ($app) {
    try{
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'username','firstName','lastName', 'password'),$r);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    $email = $r->email;
    $username = $r->username;
    $firstName = $r->firstName;
    $lastName = $r->lastName;
    $password = $r->password;

    $isUserExists = $db->getOneRecord("select 1 from users where email='$email'");
    
    if(!$isUserExists){
        $r->password = passwordHash::hash($password);
        $tabble_name = "users";
        $column_names = array('email', 'username', 'firstName', 'lastName', 'password');
        $result = $db->insertIntoTable($r, $column_names, $tabble_name);
        
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response['firstName'] = $firstName;
            $response['lastName'] = $lastName;
            $response['email'] = $email;

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $result;
            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or email exists!";
        echoResponse(201, $response);
    }
    }catch (Exception $e) {
            error_log( 'signUp  '. $e->getMessage());
     }
});
$app->post('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});
?>