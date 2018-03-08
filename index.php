<?php

   session_start();  

   /**
    * Destroy the session when logging out
    */
   if(isset($_GET['logout'])){
   		session_destroy();
    	header("Location: index.php"); //Redirect the user
   }

   function signIn(){
      echo '<div class="wrapper fadeInDown">
      		  <div id="formContent">
			    <!-- Login Form -->
                <form id="loginForm" name="loginForm" method="post">
                  <p style="margin-top: 15px;">Welcome to <b>Kout</b>, a simple chat application</p>
                  <p>Please enter your username to continue</p>
			      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Login with:" required >
			      <input type="submit" name="signIn" class="fadeIn fourth" id="signIn" value="Sign in">
			    </form>
			  </div>
			</div>';
			}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Kout - Chat application</title>
   <link rel="stylesheet" type="text/css" href="./css/style.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   <?php
		/**
		 * Check if a session already exist.
		 */
      if(!isset($_SESSION['username'])){
         signIn();
      }
      else{
   ?>

   <div class="wrapper fadeInDown">
      <div id="formContent">
      	<div class="fadeIn first">
         <p class="welcome" style="float: left; margin-top: 8px; margin-left: 10px;">Welcome, <b><?php echo $_SESSION['username']; ?></b></p>
         <p class="signout" style="float: right; margin-right: 10px; margin-top: 8px;"><a id="signout" href="#">Logout</a></p>
         <div style="clear: both;"></div>
      </div>

      <!-- Conversation displayer -->
      <div id="chatContainer" class="fadeIn second"></div>

      <!-- Send message form -->
      <form name="messages" action="" class="fadeIn third">
         <textarea style="margin-bottom: 25px;" type="text" name="msgToSend" id="msgToSend" placeholder="Type here and hit enter to send, Hit Shift+Enter for a new line...." ></textarea>
      </form>
    </div>
   </div>
   <!-- To close the else statement -->
   <?php
      }
   ?>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
           crossorigin="anonymous">
   </script>
   <script type="text/javascript" src="./js/script.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
           integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
   </script>

</body>
</html> 