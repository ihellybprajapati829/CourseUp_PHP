<?php 

include 'config.php';
include 'google_config.php';

session_start();

error_reporting(0);

include 'head.php';
if (isset($_POST['login_submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password' AND active=1";

	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $row['email'];

        if(isset($_POST['rememberme'])){

            setcookie('email',$email,time()+86400);
            setcookie('password',$_POST['password'],time()+86400);

            header("Location: welcome.php");
        }
        else{
            header("Location: welcome.php");
        }
	} 
	else {
		echo "<script>alert('Woops!! Email or Password is Wrong.')</script>";
	}
}


if (isset($_POST['submit'])) {
	$email = $_POST['semail'];
	$password = md5($_POST['spassword']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM `user` WHERE `email`='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            
            $token = bin2hex(random_bytes(10));//Random bytes

            // echo $token;

            $html = file_get_contents('./email_formats/email.html');

            $subject = "CourseUp : Email Verification";
            $url = "http://localhost/CourseUp/activate.php?token=$token";

            $html =  str_replace("{{LINK}}",$url,$html);
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: hbprajapati54@gmail.com";


            $body = htmlspecialchars_decode($html);
            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['activation_msg'] = "Check your mail $email to activate your account.";
                header("Location: index.php");
            } else {
                $_SESSION['activation_msg'] = "Verification mail is not sent.";
                header("Location: index.php");
            }

			$sql = "INSERT INTO `user` (`email`, `password`,`token`) VALUES ('$email', '$password','$token')";

			$result = mysqli_query($conn, $sql);
			if ($result) {
                header("Location: index.php");

				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} 
			else 
			{
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} 
		else {
				echo "<script>alert('User already Exists.')</script>";
		}		
	} 
	else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

if(isset($_GET["code"])){
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 if(!isset($token['error']))
 {
  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $google_service = new Google_Service_Oauth2($google_client);

  $data = $google_service->userinfo->get();

  if(!empty($data['email']))
  {
   $email = $data['email'];

   $sql = "SELECT * FROM `user` WHERE `email`='$email'";
   $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
        $sql2 = "INSERT INTO `user` (`email`, `password`,`token`,`active`) VALUES ('$email', '','',1)";

        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            header("Location: welcome.php");
    
            $email = "";
        } 
        else 
        {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    }
    else {
        header("Location: welcome.php");
    }

  }
 }
}
?>

<body>
    <header>
        <br>
        <img src="./img/Logo.png" alt="" srcset="">
    </header>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <form action="" method="POST">
                    <span style="color:green;font-size:13px"><?php if(isset($_SESSION['activation_msg'])){
                        echo $_SESSION['activation_msg'];
                    } ?></span>

                    <div class="field input-field">
                        <input type="email" oninput="validateEmail(this)" placeholder="Enter Email" name="email" class="input" value="<?php if(isset($_COOKIE['email']))
                        { echo $_COOKIE['email']; } ?>">
                        <p id="email_error" class="error"></p>
                    </div>
                    <div class="field input-field" style="margin:25px 0px">
                        <input type="password" oninput="validatePassword(this)" placeholder="Enter Password" name="password" class="password" value="<?php if(isset($_COOKIE['password']))
                        { echo $_COOKIE['password']; } ?>">
                        <i class='bx bx-hide eye-icon'></i>
                        <p id="password_error" class="error"></p>
                    </div>
                    <div class="rememberme">
                        <input type="checkbox" id="rememberme" name="rememberme" class="rememberme">
                        <label for="rememberme">Remember Me</label>
                        <div style="float:right;font-size:14px;margin-top:10px">
                            <a href="./forgot_password.php" class="forgot-pass">Forgot password?</a>
                        </div>
                    </div>

                    <div class="field button-field">
                        <button name="login_submit">Login</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">SignUp</a></span>
                </div>
            </div>
            <div class="line"></div>
            <div class="media-options">
                <?php 
                    echo '<a href="'.$google_client->createAuthUrl().'" class="field google">
                        <img src="./img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>';
                ?>
            </div>
        </div>

        <!-- Signup Form -->
        <div class="form signup">
            <div class="form-content">
                <header>Sign Up</header>
                <form action="" method="POST">
                    <div class="field input-field">
                        <input type="email" oninput="validateEmail(this)" placeholder="Enter Email" name="semail" class="input">
                        <p id="semail_error" class="error"></p>
                    </div>

                    <div class="field input-field">
                        <input type="password" oninput="validatePassword(this)" placeholder="Create Password" name="spassword" class="password" id="password">
                        <p id="spassword_error" class="error"></p>
                    </div>

                    <div class="field input-field">
                        <input type="password" oninput="validateConfirmPassword(this)" placeholder="Confirm Password" name="cpassword" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                        <p id="cpassword_error" class="error"></p>
                    </div>

                    <div class="field button-field">
                        <button name="submit">Signup</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>

            <div class="line"></div>
            <div class="media-options">
                <?php 
                    echo '<a href="'.$google_client->createAuthUrl().'" class="field google">
                        <img src="./img/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>';
                ?>
            </div>

        </div>
    </section>

    <!-- JavaScript -->
    <script src="./js/script.js"></script>
    <script>
        const validateEmail = (element) => {
            let email = element.value;
            let name = element.name;
            let pattern = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9]+[.]+[a-zA-Z.]+$/;
            if (email.length == 0) {
                document.getElementById(name+"_error").innerHTML = "*This field is required.";
            }
            else if (!email.match(pattern)) {
                document.getElementById(name+"_error").innerHTML = "*Please enter valid email format.";
            }
            else {
                document.getElementById(name+"_error").innerHTML = "";
            }
        }
        const validatePassword = (element) => {
            let password = element.value;
            let name = element.name;
            if (password.length == 0) {
                document.getElementById(name+"_error").innerHTML = "*This field is required.";
            }
            else if (password.length < 8 ) {
                document.getElementById(name+"_error").innerHTML = "*Password must be of 8 characters.";
            }
            else {
                document.getElementById(name+"_error").innerHTML = "";
            }
        }
        const validateConfirmPassword = (element) => {
            let cpassword = element.value;
            let name = element.name;
            let password = document.getElementById("password").value;
            // alert(password)
            if (password != cpassword) {
                document.getElementById(name+"_error").innerHTML = "*Password are not matching.";
            }
            else {
                document.getElementById(name+"_error").innerHTML = "";
            }
        }
    </script>
</body>

</html>