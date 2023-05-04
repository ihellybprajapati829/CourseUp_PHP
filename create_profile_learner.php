<?php

include 'config.php';

session_start();

error_reporting(0);

$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];

include 'head.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $country_code = $_POST['country_code'];
    $number = $_POST['mobile'];
    // $interest = $_POST['interest'];
    $contactno = $country_code . ' ' . $number;

    $interests = array();
    if (isset($_POST["interest"])) {
        foreach ($_POST['interest'] as $interest)
            array_push($interests, $interest);
    }
    $interest_data = json_encode($interests);
    $profilepic = $_FILES['img'];
    $filename = $profilepic['name'];
    $filepath = $profilepic['tmp_name'];
    $filesize = $profilepic['size'];
    $fileerror = $profilepic['error'];
    $filetype = $profilepic['type'];
    $fileExt = explode('.', $filename);
    $fileactualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($fileactualExt, $allowed)) {
        if ($filesize < 1000000) //10mb max
        {
            $destfile = 'profile_pic/' . $filename;
            move_uploaded_file($filepath, $destfile);

            $sql = "INSERT INTO `learner` (`usr_id`,`name`, `contact_no`, `interest`,`image`) VALUES ('$usr_id','$name','$contactno','$interest_data','$destfile')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
?>
                <script>
                    alert("Woho!!! Learner added.")
                </script>
            <?php
                header('location: ./learner/learner_dashboard.php');
            } else {
            ?>
                <script>
                    alert("Woops! Something Wrong Went.")
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Oops!! File size is too big.")
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Oops!! You cannot upload file of this extension. Please upload it in jpg, jpeg or png form.")
        </script>
<?php
    }
}

?>

<body>
    <header>
        <br>
        Create Learner Profile
    </header>
    <section class="container forms">
        <div class="form login" style="min-width:600px;">
            <div class="form-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <label for="name">Name :</label>
                        <div class="field input-field">
                            <input type="text" placeholder="Enter Name" name="name" class="input" value="<?php if (isset($_SESSION['name'])) {
                                                                                                                echo $_SESSION['name'];
                                                                                                            } ?>" onblur="validateName(this)" oninput="validateName(this)" required>
                            <p id="name_error" class="error"></p>
                        </div>
                    </div>
                    <br>


                    <div class="row">
                        <div class="col-md-6">
                            <label for="mobile">Mobile :</label>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="country_code" id="country_code" class="field input-field">
                                        <option value="(+91)">(+91)</option>
                                        <option value="(+1)">(+1)</option>
                                        <option value="(+44)">(+44)</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <div class="field input-field">
                                        <input type="text" placeholder="0000000000" name="mobile" maxlength="10" pattern="[6-9]{1}[0-9]{9}" onblur="validateMobile(this)" oninput="validateMobile(this)" class="input" required>
                                        <p id="mobile_error" class="error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="img" class="form-label">Select Profile Picture :</label>
                            <div class="row" style="margin-top:-8px">
                                <div class="field input-field">
                                    <input type="file" class="input" name="img" style="padding-top:10px" placeholder="Enter Profile Pic" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field input-field" style="margin:25px 0px">
                            <label for="interest" style="margin-bottom:18px">Interest :</label>
                            <!-- <textarea type="text" name="about" id="about"
                                placeholder="Tell us about yourself" cols="68" class="field input-field" required></textarea> -->

                            <!-- <div class="row justify-content-center mb-3">
                                    <div class="col-md-5"> -->
                            <br>
                            <!-- <div class="color-1"> -->
                            <select data-placeholder="Select Interests" multiple class="chosen-select" id="multiple-label-example" name="interest[]">
                                <option value="Design">Design</option>
                                <option value="HTML5">HTML5</option>
                                <option value="CSS3">CSS3</option>
                                <option value="jQuery">jQuery</option>
                                <option value="Bootstrap">Bootstrap</option>
                                <option value="WordPress">WordPress</option>
                                <option value="PHP">PHP</option>
                            </select>
                            <!-- </div> -->
                            <!-- </div>
                                </div> -->
                        </div>
                    </div>
                    <br>
                    <div class="field button-field">
                        <button name="submit">Create Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        function validateName(name_str) {
            let str = name_str.value;
            let name = name_str.name;

            let pattern = /^[A-Za-z\s]+$/;
            if (str.length == 0) {
                document.getElementById(name + "_error").innerHTML =
                    "*This field is required.";
            } else if (!str.match(pattern)) {
                document.getElementById(name + "_error").innerHTML =
                    "*Only characters allowed.";
            } else {
                document.getElementById(name + "_error").innerHTML = "";
            }
        }

        function validateMobile(mobile) {
            let number = mobile.value;
            let name = mobile.name;
            let pattern = /^[6-9]{1}[0-9]{9}$/;
            if (number.length == 0) {
                document.getElementById(name + "_error").innerHTML = "*This field is required.";
            } else if (!number.match(pattern)) {
                document.getElementById(name + "_error").innerHTML = "*Enter valid number.";
            } else {
                document.getElementById(name + "_error").innerHTML = "";
            }
        }
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chosen.jquery.min.js"></script>

    <script src="js/select.js"></script>
</body>

</html>