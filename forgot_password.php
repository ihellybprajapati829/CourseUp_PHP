<?php 

include 'config.php';

session_start();

error_reporting(0);

include 'head.php';

if (isset($_POST['submit'])) {
	$email = $_POST['email'];

		$sql = "SELECT * FROM `user` WHERE `email`='$email'";
		$result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            
            $token = bin2hex(random_bytes(10));//Random bytes

            $html = file_get_contents('./email_formats/forgot_email.html');

            $subject = "CourseUp : Reset Password";
            $url = "http://localhost/CourseUp/reset_password.php?token=$token";

            $html =  str_replace("{{LINK}}",$url,$html);
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: hbprajapati54@gmail.com";


            $body = htmlspecialchars_decode($html);
            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['activation_msg'] = "Check your mail $email to reset password.";
                header("Location: index.php");
            } else {
                $_SESSION['activation_msg'] = "Reset mail is not sent.";
                header("Location: index.php");
            }

            $sql = "UPDATE `user` SET `token` = '$token' WHERE `user`.`email` = '$email';";

			$result = mysqli_query($conn, $sql);
			if ($result) {
                header("Location: index.php");
				$email = "";
			} 
			else 
			{
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} 
		else {
				echo "<script>alert('User Not Exists.')</script>";
		}		
}


?>

<body>
    <header>
        <br>
        <img src="./img/Logo.png" alt="" srcset="">
    </header>
    <section class="container forms">
        <div class="form login" style="margin-bottom:180px">
            <div class="form-content">
                <header>Forgot Password</header>
                <form action="" method="POST">
                    <div class="field input-field">
                        <input type="email" oninput="validateEmail(this)" placeholder="Enter Email" name="email" class="input" value="<?php if(isset($_COOKIE['email']))
                        { echo $_COOKIE['email']; } ?>">
                        <p id="email_error" class="error"></p>
                    </div>
                    <div class="field button-field">
                        <button name="submit">Continue</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Back To <a href="./index.php">Login</a> Page</span>
                </div>
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
    </script>
</body>

</html>