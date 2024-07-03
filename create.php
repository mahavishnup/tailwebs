<?php
declare(strict_types=1);
session_start();
include("inc/config.php");
if (!isset($_SESSION["uid"])) {
    header("location:index.php");
}

if (isset($_POST["CREATE"])) {
    global $con;
    $sname = $_POST["name"];
    $ssubject = $_POST["subject"];
    $smark = $_POST["mark"];

    $validateQuery = $con->prepare("SELECT * FROM students WHERE name = :name and subject = :subject");
    $validateQuery->bindParam(':name', $sname, PDO::PARAM_STR);
    $validateQuery->bindParam(':subject', $ssubject, PDO::PARAM_STR);
    $validateQuery->execute();

    if ($val = $validateQuery->fetch(PDO::FETCH_ASSOC)) {
        $newQuery = $con->prepare("UPDATE students SET mark = :mark WHERE uid = :sid");
        $newQuery->bindParam(':sid', $val['uid'], PDO::PARAM_STR);
        $newQuery->bindParam(':mark', $smark, PDO::PARAM_STR);
        $newQuery->execute();
    } else {
        $newQuery = $con->prepare("INSERT INTO students (name, subject, mark) VALUES (:name, :subject, :mark)");
        $newQuery->bindParam(':name', $sname, PDO::PARAM_STR);
        $newQuery->bindParam(':subject', $ssubject, PDO::PARAM_STR);
        $newQuery->bindParam(':mark', $smark, PDO::PARAM_STR);
        $newQuery->execute();
    }

    if (!$newQuery->fetch(PDO::FETCH_ASSOC)) {
        echo "<script>alert('Something went to wrong!');</script>";
    }
}

header("location:dashboard.php");
exit;
?>