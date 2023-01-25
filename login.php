<?php include_once 'php-components/header.php'; ?>

<img class="wave" src="img/wave.png">
	<div class="container_login">
		<!-- <div class="img">
			<img src="img/undraw_visionary_technology_re_jfp7.svg">
		</div> -->
		<div class="login-content">
			<form class="login" action="includes1/login.inc.php" method="post">
				<!-- <img class="" src="img/nta_logo_small.png" style="width: 100px;"> -->
				<!-- <h2 class="title" style="color: white; text-shadow: 2px 2px 4px #000000;">Welcome</h2> -->
           		<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
           		   		<input name="username" type="text" class="form-control" placeholder="username" required>
           		</div>
                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
           		   		<input name="password" type="password" class="form-control" placeholder="password" required>
           		</div>
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
                <a href="#" style="display:block;">Forgot Password?</a>
            </form>
        </div>
    </div>
	
    <?php include_once 'php-components/footer.php'; ?>