<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
}

$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];
$tutor_id = $_SESSION['tutor_id'];

$sql = "SELECT * FROM `tutor` WHERE `usr_id`='$usr_id'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $imagePath = $row['image'];

    $image = "../" . $imagePath;
    $_SESSION['name'] = $name;
    $_SESSION['image'] = $image;
    $_SESSION['tutor_id'] = $row['id'];
}

?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Learning & Course Management System</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <style>
        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }
    </style>
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>

    <main class="d-flex flex-nowrap">

        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <img src="../img/White_Logo.png" alt="" srcset="" style="width:200px;">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="./tutor_dashboard.php" class="nav-link text-white">
                        Home
                    </a>
                </li>
                <li>
                    <a href="./tutor_course.php" class="nav-link text-white">
                        Courses
                    </a>
                </li>
                <li>
                    <a href="./add_course.php" class="nav-link text-white">
                        Add Course
                    </a>
                </li>
                <li>
                    <a href="./delete_course.php" class="nav-link text-white">
                        Delete Courses
                    </a>
                </li>
                <li>
                    <a href="./payment_status.php" class="nav-link text-white">
                        Payment Status
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $image; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>&nbsp;<?php echo $name; ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./signout.php">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="b-example-divider b-example-vr"></div>

        <div class="flex-shrink-0 p-4 contact" style="width: 75%;">
            <div class="container">
                <br>
                <h2>Payment Status</h2>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for="start">Start Date :</label>
                        <input type="date" id="start" style="outline:none; padding:2% 4%; border: 1px solid grey;color:grey">
                    </div>
                    <div class="col-md-3">
                        <label for="end">End Date :</label>
                        <input type="date" id="end" style="outline:none; padding:2% 4%; border: 1px solid grey;color:grey">
                    </div>
                    <div class="col-md-3">
                        <input type="button" id="submit" value="Apply Filter" class="btn btn-success" style="border-radius:0;margin:8% 0%">
                    </div>
                </div>
                <br>
                <div id="selected_orders_table"></div>
                <br>
                <br>
                <div id="order_table">
                    <?php
                    $query = "SELECT o.`id`, l.`name`as 'learner' ,c.`name` as 'course',o.`amount`,o.`created_at` FROM `orders` o INNER JOIN `course` c ON o.`course_id` = c.`id` INNER JOIN `learner` l ON l.`id` = o.`usr_id` WHERE c.`tutor_id`='$tutor_id'";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                    ?>
                        <h5>All Orders</h5>
                        <div class="container">
                            <table class="table" id="orders">
                                <thead>
                                    <th>Order Id.</th>
                                    <th>Learner Name</th>
                                    <th>Course Name</th>
                                    <th>Amount(In Rs.)</th>
                                    <th>Order DateTime</th>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['learner'] ?></td>
                                            <td><?= $row['course'] ?></td>
                                            <td><?= $row['amount'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                        </tr>
                        </div>
                    <?php
                                    } ?>
                    </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export Payment Report</button>
            </div>
        <?php
                    } else {
                        echo "<br><h6>No Orders Yet...</h6>";
                    } ?>
        <br>
        </div>
        </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!-- Sheetjs -->
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('orders');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Payment_Report.' + (type || 'xlsx')));
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#orders').DataTable();

            $('#submit').click(function() {
                var start_date = $('#start').val();
                var end_date = $('#end').val();
                if ((start_date > end_date) || (start_date == "" || end_date == "")) {
                    alert("Please select valid dates.");
                } else {
                    $.ajax({
                        url: './orders_ajax.php',
                        type: "POST",
                        dataType: "html",
                        data: {
                            start_date: start_date,
                            end_date: end_date
                        },
                        success: function(res) {
                            $('#selected_orders_table').html(res);
                            $('#orders').DataTable();
                            $('#order_table').hide();
                        }
                    })
                }
            })
        });
    </script>
</body>

</html>