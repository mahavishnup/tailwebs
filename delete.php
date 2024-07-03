<?php
declare(strict_types=1);
session_start();
include("inc/config.php");
if (!isset($_SESSION["uid"])) {
    header("location:index.php");
}

if (isset($_POST["DELETE"])) {
    global $con;

    $sid = $_POST["sid"];
    $stQuery = $con->prepare("DELETE FROM students WHERE uid = :sid");
    $stQuery->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stQuery->execute();
}

header("location:dashboard.php");
exit;
?>