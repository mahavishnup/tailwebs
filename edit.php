<?php
declare(strict_types=1);
session_start();
include("inc/config.php");
if (!isset($_SESSION["uid"])) {
    header("location:index.php");
}

if (isset($_POST["UPDATE"])) {
    global $con;

    $sid = $_POST["sid"];
    $sname = $_POST["name"];
    $ssubject = $_POST["subject"];
    $smark = $_POST["mark"];

    $newQuery = $con->prepare("UPDATE students SET name = :name, subject = :subject, mark = :mark WHERE uid = :sid");
    $newQuery->bindParam(':sid', $sid, PDO::PARAM_STR);
    $newQuery->bindParam(':name', $sname, PDO::PARAM_STR);
    $newQuery->bindParam(':subject', $ssubject, PDO::PARAM_STR);
    $newQuery->bindParam(':mark', $smark, PDO::PARAM_STR);
    $newQuery->execute();

    if (!$newQuery->fetch(PDO::FETCH_ASSOC)) {
        echo "<script>alert('Something went to wrong!');</script>";
    }
}

header("location:dashboard.php");
exit;
?>