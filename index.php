<?php
declare(strict_types=1);
session_start();
include("inc/config.php");
$title = 'Teacher Portal';
require_once 'src/functions.php';
$meta = getMetaSeo(['title' => $title]);
require_once 'inc/header.php';

if (isset($_POST["submit"])) {
    global $con;

    $uname = $_POST["uname"];
    $upass = $_POST["upass"];
    $query = $con->prepare("SELECT * FROM users WHERE uname = :username and upass = :userpass");
    $query->bindParam(':username', $uname, PDO::PARAM_STR);
    $query->bindParam(':userpass', $upass, PDO::PARAM_STR);
    $query->execute();
    if ($results = $query->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION["uid"] = $results["uid"];
        $_SESSION["uname"] = $results["uname"];
        header("location:dashboard.php");
    } else {
        echo "<script>alert('Invalid Detail');</script>";
    }
}
?>

<div class="wrapper indexPage container">
    <div class="mainSection">
        <div class="searchContainer" style="text-align: center; width: 420px;">
            <h2>Teacher Portal</h2>
            <br/>
            <form action="/" method="POST" autocomplete="off">
                <input type="text" class="searchBox" placeholder="Enter Username" name="uname"/><br/>
                <input type="password" class="searchBox" placeholder="Enter Password" name="upass"/>
                <input class="searchButton" type="submit" name="submit" value="Log In"/>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'inc/footer.php';
?>
