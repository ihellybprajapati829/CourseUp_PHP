<?php 

include 'config.php';

session_start();

error_reporting(0);

$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];

include 'head.php';

if (isset($_POST['submit'])) {
	$selector = $_POST['selector'];

    $sql = "UPDATE `user` SET `selector` = '$selector' where `email`='$email'";

    $result = mysqli_query($conn, $sql);

    if($result){
        if($selector == "learner"){
            header("Location: create_profile_learner.php");
        }
        if($selector == "tutor"){
            header("Location: create_profile_tutor.php");
        }
    }
}
?>

<body>
<header>
        <br>
        <img src="./img/Logo.png" alt="" srcset="">
        <h3>Welcome to CourseUp! <img src="./img/celebration.png" alt=""></h3>
    </header>
    <section style="margin:2%" align="center">
        <h5>Select your role...</h5>
        <div class="row">
            <form action="" method="POST">
                <label for="learner">
                    <div class="selector">
                        <div class="img-box" id="llearner">
                            <img src="./img/student_icon.png" alt="" srcset="">
                            <h5>Student</h5>
                        </div>
                    </div>
                </label>
                <input type="radio" name="selector" id="learner" value="learner" hidden>

                <label for="tutor">
                    <div class="selector">
                        <div class="img-box" id="ltutor">
                            <img src="./img/tutor_icon.png" alt="" srcset="">
                            <h5>Tutor</h5>
                        </div>
                    </div>
                </label>
                <input type="radio" name="selector" id="tutor" value="tutor" hidden>
                <div style="width:200px;margin-left:42%;margin-top:2%">
                    <div class="field button-field">
                        <button name="submit" style="padding:4%">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $("#tutor").click(function(){
                $("#ltutor").css({"border":"2px double #444F5A"});
                $("#llearner").css({"border":"none"})
            });
            $("#learner").click(function(){
                $("#llearner").css({"border":"2px double #444F5A"});
                $("#ltutor").css({"border":"none"});
            });
        })
    </script>
</body>

</html>