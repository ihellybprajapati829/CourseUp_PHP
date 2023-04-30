<?php

include '../config.php';
session_start();

$tutor_id = $_SESSION['tutor_id'];

if (isset($_POST['start_date'])) {

    $sdate = $_POST['start_date'];
    $edate = $_POST['end_date'];
    // echo $edate;

    $query = "SELECT o.`id`, l.`name`as 'learner' ,c.`name` as 'course',o.`amount`,o.`created_at` FROM `orders` o INNER JOIN `course` c ON o.`course_id` = c.`id` INNER JOIN `learner` l ON l.`id` = o.`usr_id` WHERE c.`tutor_id`='$tutor_id' AND (CAST(o.`created_at` AS DATE) BETWEEN '$sdate' AND '$edate')";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
?>

        <div class="container">
            <h5>Filtered Orders</h5>
            <table class="table" id="orders">
                <thead>
                    <th>Order Id.</th>
                    <th>Learner Name</th>
                    <th>Course Name</th>
                    <th>Amount(In Rs.)</th>
                    <th>Order DateTime</th>
                </thead>
                <tbody>
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
<?php
    } else {
        echo "<h6>No orders in this duration.</h6>";
    }
}
?>