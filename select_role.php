<?php 

include 'config.php';

session_start();

error_reporting(0);

$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];

include 'head.php';
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
            <form action="">
                <label for="learner">
                    <div class="selector">
                        <div class="img-box">
                            <img src="./img/student_icon.png" alt="" srcset="">
                            <h5>Student</h5>
                        </div>
                    </div>
                </label>
                <!-- <input type="radio" name="selector" id="learner"> -->

                <label for="tutor">
                    <div class="selector">
                        <div class="img-box">
                            <img src="./img/tutor_icon.png" alt="" srcset="">
                            <h5>Tutor</h5>
                        </div>
                    </div>
                </label>
                <!-- <input type="radio" name="selector" id="tutor"> -->
                <div style="width:200px;margin-left:42%;margin-top:2%">
                    <div class="field button-field">
                        <button name="submit" style="padding:4%">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>