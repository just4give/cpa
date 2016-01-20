<!DOCTYPE html>
<html ng-app="cpa">
  <head>
    <title>Corporate Pilots Association</title>
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

	  <link href="vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/jasny-bootstrap.min.css" rel="stylesheet"><!--/used for offscreen mobile menu -->
	  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	  <link href="vendor/angular/angular-csp.css" rel="stylesheet">
	  <link href="vendor/animate.css/animate.min.css" rel="stylesheet">
	  <link href="vendor/angularjs-toaster/toaster.min.css" rel="stylesheet">

	  <link href="css/cpa.css" rel="stylesheet" media="screen">
  
<!--/start google analytics --> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71832172-1', 'auto');
  ga('send', 'pageview');

</script>
<!--/end google analytics --> 
 
 
</head>

<body data-target="#topnav" id="body">

	<toaster-container toaster-options="{'close-button': true}"></toaster-container>
<!--/start offcanvas navbar -->	
    <div id="offcanvas-menu" class="navmenu navmenu-default navmenu-fixed-right offcanvas" ng-controller="loginController">
	    <div class="navmenu-logo text-center">
			<img alt="web design madcam designs" src="images/logo.png" class="logo"/>
	    </div>
    	<ul class="nav navmenu-nav">
		<li class="active"><a href="#home">home</a></li>
			<li class="dropdown">
			 	<a href="programs.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">member services <span class="caret"></span></a>
			 	<ul class="dropdown-menu" role="menu">
			 		<li><a href="birthdays.html">BIRTHDAY PARTIES</a></li>
			 		<li><a href="amusements.html">FRIDAY FUNHOUSE</a></li>
          		</ul>
		  	</li>
			<li><a href="#bylays.html">bylaws</a></li>
			<li><a href="#join">how to join</a></li>
			<li><a href="#letstalk">let's talk</a></li>
			<li class="dropdown" ng-show="!loggedIn">
            	<a class="dropdown-toggle" href="#" data-toggle="dropdown">sign in<strong class="caret"></strong></a>
					<div class="dropdown-menu" style="padding: 15px; width:300px">
						<form name="flogin">
							<div class="form-group" ng-class="{ 'has-error': flogin.email.$invalid }">
								<label class="sr-only" for="email">Email address</label>
								<input type="email" name="email" ng-model="loginuser.email" class="form-control" id="email" required placeholder="Enter email">
							</div>
							<div class="form-group" ng-class="{ 'has-error': flogin.password.$invalid }">
								<label class="sr-only" for="password">Password</label>
								<input type="password" name="password" ng-model="loginuser.password" class="form-control" id="password" required placeholder="Password">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> remember me
								</label>
							</div>
							<button class="btn btn-login btn-block" ng-click="login()" ng-disabled="flogin.$invalid">Sign In</button>
						</form>
            		</div>
          </li>
        <li class="dropdown " ng-show="loggedIn">
            <a class="dropdown-toggle " data-toggle="dropdown">{{bootstrappedUser.firstName}}<strong class="caret"></strong></a>
            <ul class="dropdown-menu" style="padding: 15px; width:300px">

                    <li><a class="btn btn-link" href="#/profile">My Profile</a></li>
                    <li><button  class="btn btn-link" ng-click="logout()">Logout</button></li>

            </ul>
        </li>

      </ul>
    </div>
<!--/end offcanvas navbar -->	

<!--/start navbar -->	  
	  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <img class="pull-left logo margin-left-15 margin-right-20 margin-top-5" src="images/logo.png"/>
	  	<div class="navbar-header"><!--/this is mobile menu-->
			<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
    	<div class="collapse navbar-collapse" ng-controller="loginController"><!--/this collapses menu for mobile -->
    	<ul id="nav" class="nav navbar-nav navbar-right">
			<li class="active"><a href="#home">home</a></li>
			<li><a href="#home">about</a></li>
			<li class="dropdown">
			 	<a href="programs.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" ng-show="isSubscribed">member services <span class="caret"></span></a>
			 	<ul class="dropdown-menu" role="menu">
			 		<li><a href="#/member.bluestar">Blue Star</a></li>
			 		<li><a href="amusements.html">Code of Ethics</a></li>
			 		<li><a href="amusements.html">Committees</a></li>
			 		<li><a href="amusements.html">Crisis Management</a></li>
			 		<li><a href="amusements.html">Government Affairs</a></li>
			 		<li><a href="amusements.html">Help Line</a></li>
			 		<li><a href="amusements.html">Insurance</a></li>
			 		<li><a href="amusements.html">NASA Reporting</a></li>
			 		<li><a href="amusements.html">Pilots Bill of Rights</a></li>
			 		<li><a href="amusements.html">Safety Audits</a></li>
			 		<li><a href="amusements.html">Security</a></li>
          		</ul>
		  	</li>
		  	<li class="dropdown">
			 	<a href="programs.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">partnerships <span class="caret"></span></a>
			 	<ul class="dropdown-menu" role="menu">
			 		<li><a href="birthdays.html">Aircraft Appraisals</a></li>
			 		<li><a href="amusements.html">Aircraft financing</a></li>
			 		<li><a href="amusements.html">Aircraft Management</a></li>
			 		<li><a href="amusements.html">Aircraft Reference</a></li>
			 		<li><a href="amusements.html">Cabin Attendants</a></li>
			 		<li><a href="amusements.html">Charter Services</a></li>
			 		<li><a href="amusements.html">Facilities Constructions</a></li>
			 		<li><a href="amusements.html">Pilot Training</a></li>
          		</ul>
		  	</li>
			<li><a href="#join">how to join</a></li>
			<li><a href="#letstalk">let's talk</a></li>
			<li class="dropdown " ng-show="!loggedIn">
            	<a class="dropdown-toggle " id="login-menu" href="#" data-toggle="dropdown">sign in<strong class="caret"></strong></a>
					<div class="dropdown-menu" style="padding: 15px; width:300px">
						<form name="flogin">
							<div class="form-group" ng-class="{ 'has-error': flogin.email.$invalid }">
								<label class="sr-only" for="email2">Email address</label>
								<input type="email" name="email" ng-model="loginuser.email" class="form-control" id="email2" required placeholder="Enter email">
							</div>
							<div class="form-group" ng-class="{ 'has-error': flogin.password.$invalid }">
								<label class="sr-only" for="password2">Password</label>
								<input type="password" name="password" ng-model="loginuser.password" class="form-control" id="password2" required placeholder="Password">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> remember me
								</label>
							</div>
							<button class="btn btn-login btn-block" ng-click="login()" ng-disabled="flogin.$invalid">Sign In</button>
						</form>
            		</div>
          </li>
		<li class="dropdown " ng-show="loggedIn">
			<a class="dropdown-toggle "  data-toggle="dropdown">{{bootstrappedUser.firstName}}<strong class="caret"></strong></a>
			<ul class="dropdown-menu" style="padding: 15px; width:300px">

					<li><a class="btn btn-link" href="#/profile">My Profile</a></li>
					<li><button  class="btn btn-link" ng-click="logout()">Logout</button></li>

			</ul>
		</li>
		</ul>
    	</div>
    	</div>
<!--/end navbar -->

<div ui-view class="page-view"></div>

<!--/end container -->  

         
<!-- start footer section -->  
  	<div class="row footer">
	  	<div class="row">
		  	<div class="col-sm-12">
     			<img alt="primrose companies logo" class="hidden-xs hidden-sm logo-sm center-img" src="images/logo.png">
			</div>
    		<div class="col-sm-12 text-center pad-top-20">
				<address>
					<address>
						<strong>Corporate Pilots Association</strong><br>
						200 Hanscom Drive, Suite 322 - P.O. Box 685 - Bedford, MA 01730<br>
						<i class="fa fa-phone fa-fw"></i> 781.860.7403  <i class="fa fa-fax fa-fw"></i> 781.860.5105 <i class="fa fa-envelope fa-fw"></i><a href="mailto:info@cpa.aero"> Email Us</a><br>
						
					</address>
    		</div>
	  	</div>
	  	<div class="row">
			<div class="col-xs-12">
				<a href="http://www.madcamdesigns.com/" rel="author"><img alt="madcam designs" class="center-img" src="images/madcam-logo.png"></a>
			</div>
			<div class="col-sm-4">
				<span id="top-link-block" class="hidden">
					<a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
					<i class="fa fa-angle-double-up fa-lg"></i></a>
				</span>
			</div>
	  	</div>
	</div> 
<!-- end footer section -->  


    
	<!-- linked javascript files -->
   <!-- <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>-->


	<script src="vendor/jquery/dist/jquery.min.js"></script>
	<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>



	<script src="vendor/angular/angular.min.js"></script>
	<script src="vendor/angular-ui-router/release/angular-ui-router.min.js"></script>
	<script src="vendor/angular-animate/angular-animate.min.js"></script>
	<script src="vendor/angular-touch/angular-touch.min.js"></script>
	<script src="vendor/angular-bootstrap/ui-bootstrap.min.js"></script>
	<script src="vendor/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
	<script src="vendor/angular-confirm-modal/angular-confirm.js"></script>
	<script src="vendor/angular-local-storage/dist/angular-local-storage.min.js"></script>
	<script src="vendor/angularjs-toaster/toaster.min.js"></script>

	<script src="modules/app/AppModule.js"></script>

	<script src="modules/shared/AuthService.js"></script>
	<script src="modules/app/AppConfig.js"></script>

	<script src="modules/app/HomeController.js"></script>
	<script src="modules/shared/LoginController.js"></script>
	<script src="modules/shared/RegistrationController.js"></script>
    <script src="modules/membership/ProfileController.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script><!--/used for offscreen mobile menu -->
	<script src="js/cpa.js"></script>
	<script src="js/jquery.touchwipe.min.js"/>

</body>
</html>