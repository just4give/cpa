<!DOCTYPE html>
<html >
  <head>
    <title>Email verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="madcamdesigns.com">
    
    <!-- linked css files -->
    <!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">-->

    <!--<link href="css/font-awesome.min.css" rel="stylesheet" media="screen">-->

    <!--<link href="css/animate.css" rel="stylesheet" media="screen">-->
	
	<!-- linked google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700' rel='stylesheet' type='text/css'>

	  <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href="/css/jasny-bootstrap.min.css" rel="stylesheet"><!--/used for offscreen mobile menu -->
	  <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	  <link href="/vendor/angular/angular-csp.css" rel="stylesheet">
	  <link href="/vendor/animate.css/animate.min.css" rel="stylesheet">
	  <link href="/vendor/angularjs-toaster/toaster.min.css" rel="stylesheet">

	  <link href="/css/cpa.css" rel="stylesheet" media="screen">
  

 
 
</head>

<body >
	<div class="container text-center">

		<?php 
			require_once 'dbHandler.php';

			$db = new DbHandler();
			if(isset($_GET["token"]) ){
			$token = $_GET["token"];	
			
			 $dbToken = $db->getOneRecord("select userId from tokens where token='$token' and type='email'");
			 if($dbToken !=NULL){

			 	$userId = $dbToken['userId'];

			 	$updRow = $db->updateRecord("update users set verified=1 where id=".$userId);


			 	//print_r($updRow);
			 	if($updRow>0){

			 		$db->updateRecord("delete from tokens  where token='$token'");

			 		if (!isset($_SESSION)) {
                		session_start();
		            }
		            
		            $_SESSION['verified'] = 1;


			 		echo	'<h3>Your account is verified</h3>
							 <div class="row ">
								<a class="btn btn-success" href="/#/profile" >Back to site</a>
							</div>';
			 	}else{
			 		echo	'<h3>You already verified your account earlier</h3>
							 <div class="row ">
								<a class="btn btn-success" href="/#/profile" >Back to site</a>
							</div>';
			 	}


			 }else{
				echo '<h3 class="text-danger">Invalid request.</h3>';
			 }


			

			}else{
				echo '<h3 class="text-danger">Your account can not be verified</h3>';
			}

		?>		
		
	</div>

	<script src="/vendor/jquery/dist/jquery.min.js"></script>
	<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/js/jquery.touchwipe.min.js"></script>

</body>
</html>