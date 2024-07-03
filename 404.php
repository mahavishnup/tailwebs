<?php
declare(strict_types=1);
$title = '404';
require_once 'src/functions.php';
$meta = getMetaSeo(['title' => $title]);
require_once 'inc/header.php';
?>

<div class="wrapper indexPage container">
    <div class="mainSection">
        <div class="searchContainer" style="text-align: center; width: 420px;">
            <h2>404</h2>
            <br/>
            <h2 class="mb-3">Opps! We Can't Find the page</h2>
            <div class="mt-5">
                <a href="/"><span>Back To Home</span> </a>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'inc/footer.php';
?>
