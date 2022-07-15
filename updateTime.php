<?php 
session_start();
ob_start();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $date = date("Y-m-d");
    $start = $date." ".$_POST['start'];
    echo $start."<br>";
    $did = $_SESSION['id'];
    $end = $date." ".$_POST['end'];
    echo $end."<br>";
    include './includes/conn.php';
    $val = mysqli_query($conn, "UPDATE users SET start='$start', end='$end' WHERE deviceid = '$did'");
    if($val)
    {
        echo "success";
        header('Location: statusinfo.php');
    }
    else 
    {
        echo "Failed";
    }
    // $current = date("Y-m-d H:i", strtotime("+30 minutes"));
    // echo $current."<br>";
    // if($start < $current && $current < $end)
    // {
    //     echo "Continue";
    // }
    // else
    // {
    //     echo "Not to Continue";
    // }
}
else 
{
    echo "Unauthorized User!";
}
?>