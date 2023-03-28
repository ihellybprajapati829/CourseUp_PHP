<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_POST['login_submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password'";

	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['email'] = $row['email'];

        if(isset($_POST['rememberme'])){

            setcookie('email',$email,time()+86400);
            setcookie('password',$_POST['password'],time()+86400);

            // echo "<script>alert('Woho!! Right Password.')</script>";
            header("Location: welcome.php");
        }
        else{
            header("Location: welcome.php");
            // echo "<script>alert('Woho!! Right Password.')</script>";
        }
	} 
	else {
		echo "<script>alert('Woops!! Email or Password is Wrong.')</script>";
	}
}


if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM `user` WHERE `email`='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            
            $token = bin2hex(random_bytes(10));//Random bytes

            // echo $token;

            $subject = "Email Verification";
            $body = "Hi, This is test email send by PHP Script http://localhost/CourseUp/activate.php?token=$token";
            $headers = "From: hbprajapati54@gmail.com";

            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['activation_msg'] = "Check your mail to $email";
                header("Location: index.php");
                echo "Email successfully sent to $to_email...";
            } else {
                echo "Email sending failed...";
            }


			$sql = "INSERT INTO `user` (`email`, `password`,`token`) VALUES ('$email', '$password','$token')";

			$result = mysqli_query($conn, $sql);
			if ($result) {
				// echo "<script>alert('Wow! User Registration Completed.')</script>";
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
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}		
	} 
	else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning & Course Management System</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">

    <!--Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header>
        <br>
        <img src="./img/Logo.png" alt="" srcset="">
    </header>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <span><?php if(isset($_SESSION['activation_msg'])){
                    echo $_SESSION['activation_msg'];
                } ?></span>
                <form action="" method="POST">
                    <div class="field input-field">
                        <input type="email" placeholder="Enter Email" name="email" class="input" value="<?php if(isset($_COOKIE['email']))
                        { echo $_COOKIE['email']; } ?>">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" name="password" class="password" value="<?php if(isset($_COOKIE['password']))
                        { echo $_COOKIE['password']; } ?>">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="rememberme">
                        <input type="checkbox" id="rememberme" name="rememberme" class="rememberme">
                        <label for="rememberme">Remember Me</label>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
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
                <a href="#" class="field google">
                    <img src="./img/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>
        </div>

        <!-- Signup Form -->
        <div class="form signup">
            <div class="form-content">
                <header>Sign Up</header>
                <form action="" method="POST">
                    <div class="field input-field">
                        <input type="email" placeholder="Email" name="email" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Create password" name="password" class="password">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Confirm password" name="cpassword" class="password">
                        <i class='bx bx-hide eye-icon'></i>
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
                <a href="#" class="field google">
                    <img src="./img/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>

        </div>
    </section>

    <!-- JavaScript -->
    <script src="./js/script.js"></script>
</body>

</html>