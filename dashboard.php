<?php
declare(strict_types=1);
session_start();
include("config.php");
if (!isset($_SESSION["uid"])) {
    header("location:index.php");
}

$title = 'Dashboard';
require_once 'src/functions.php';
$meta = getMetaSeo(['title' => $title]);
require_once 'inc/header.php';
?>

    <div class="wrapper indexPage container">
        <div class="mainSection">
            <div class="searchContainer" style="text-align: center; width: 420px;">
                <h2>Dashboard</h2>
                <br/>
            </div>
        </div>
    </div>

<?php
require_once 'inc/footer.php';
?>