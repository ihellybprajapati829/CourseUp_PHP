<?php 

include 'config.php';

session_start();

error_reporting(0);

include 'head.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];

    if (isset($_POST['submit'])) {
        $email = $_POST['semail'];
        $password = md5($_POST['spassword']);
        $cpassword = md5($_POST['cpassword']);
    
        if ($password == $cpassword) {
            $sql = "SELECT * FROM `user` WHERE `token`='$token'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                echo "Hello";
    
                $row = mysqli_fetch_assoc($result);
                $_SESSION['email'] = $row['email'];
                 
                $updatequery = "UPDATE `user` SET `password`='$password' where `token`='$token'";
    
                $result = mysqli_query($conn, $updatequery);
                if ($result) {
                    $_SESSION['activation_msg'] = "Password is reset now.";
                    header("Location: index.php");
                } 
                else 
                {
                    echo "<script>alert('Woops! Something Wrong Went.')</script>";
                }
            } 
            else {
                    echo "<script>alert('Token Wrong.')</script>";
            }		
        } 
        else {
            echo "<script>alert('Password Not Matched.')</script>";
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
                <header>Reset Password</header>
                <form action="" method="POST">

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
                        <button name="submit">Update Password</button>
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

<?php 
}

?>
