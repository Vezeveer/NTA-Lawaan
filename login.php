<?php include_once 'php-components/header.php'; ?>

<img class="wave" src="img/wave.png">
	<div class="container_login">
		<div class="img">
			<img src="img/undraw_visionary_technology_re_jfp7.svg">
		</div>
		<div class="login-content">
			<form action="includes1/login.inc.php" method="post">
				<img class="threeD" src="img/nta_logo_small.png">
				<h2 class="title" style="color: white; text-shadow: 2px 2px 4px #000000;">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input name="username" type="text" class="input" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input name="password" type="password" class="input" required>
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
				<?php
					if(isset($_GET["error"])){
						if($_GET["error"] == "emptyinput"){
							echo "<p>Fill in all fields!</p>";
						}
						else if($_GET["error"] == "userdoesnotexist" || $_GET["error"] == "wrongpassword"){
							echo "<p id=\"logfade\">Username or Password is incorrect!</p>";
							echo "<style>#logfade{color:red;}</style>
								<script>
								$(function(){ 
									$('#logfade')
									.fadeOut(3000); 
								}); </script>";
						}
					}
				?>
				
            	<button type="submit" name="submit" class="btn">LOGIN</button>
            </form>
        </div>
    </div>
	
    <?php include_once 'php-components/footer.php'; ?>