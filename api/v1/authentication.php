<?php 


require '.././libs/PHPMailer/PHPMailerAutoload.php';


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
    $user = $db->getOneRecord("select id,firstName,lastName,password,email,verified from users where email='$email'");
    if ($user != NULL) {
        

        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['firstName'] = $user['firstName'];
        $response['lastName'] = $user['lastName'];
        $response['id'] = $user['id'];
        $response['email'] = $user['email'];
        $response['verified'] = $user['verified'];
        
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['verified'] = $user['verified'];
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
            $response['verified'] = 0;

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $result;
            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['verified'] = 0;

            //send verification email 
            
            sendEmail($result,'email');

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

$app->post('/resend', function() {
   
    
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['id']))
    {
        if(sendEmail($_SESSION['id'],'email')){
            $response["status"] = "info";
            $response["message"] = "Verification email has been sent";
            echoResponse(200, $response);
 
        }else{
            $response["status"] = "error";
            $response["message"] = "Failed to send verification email";
            echoResponse(200, $response);
        }
        
    }else{
        $response["status"] = "error";
        $response["message"] = "Unauthorized";
        echoResponse(403, $response);
    }
    
});
 
function sendEmail($userId, $type){
            

            $db = new DbHandler();

            $user = $db->getOneRecord("select id,firstName,lastName,password,email,verified from users where id=".$userId);
    
            $uuid = uniqid();
            $recEmail = $user['email'];
            $recName  = $user['firstName'];
            $row["userId"] = $userId;
            $row["token"] = $uuid;
            $row["type"] = $type;
            $row["createdOn"] = date('Y-m-d H:i:s'); 

            $token = $db->insertIntoTable($row, array('userId','token', 'type', 'createdOn'), "tokens");

            $mail = new PHPMailer;    
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'noreply.techfcous@gmail.com';                 // SMTP username
            $mail->Password = 'Appstacksolutions';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('admin@cpa.local.com', 'Admin');
            $mail->addAddress($recEmail, $recName);     // Add a recipient


            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'CPA - Verify your email';
            $mail->Body    = 'Please click below link to to activate your CPA account. <br>' 
                             .'<a href="http://cpa.local.com/api/v1/verifyemail.php?token='. $uuid 
                             .'">Activate Account</a>';

           // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                error_log('Mailer Error: ' . $mail->ErrorInfo);
                return false;
            } else{
                return true;
            }

}
?>