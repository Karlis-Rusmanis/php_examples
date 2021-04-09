<?php
include "head.php";
$page = '42_link';
$link_count = 42;


?>

<style>
    a.btn {
        margin: 5px;
    }
</style>

<div class="container">
    <?php include "navigation.php"; ?>

    <form action="">
        <div class="mb-3">
            <label for="link-amount" class="form-label">Amount of links</label>
            <input id="link-amount" type="number" name="amount" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>

    <?php
    if (
        array_key_exists('amount', $_GET) &&
        is_numeric($_GET['amount']) &&
        $_GET['amount'] != ''
    ) {
        $link_count = $_GET['amount'];
    }

    for ($i = 1; $i <= $link_count; $i++) {
        if ($i % 6 == 0) {
            echo "<a href='?amount=$link_count&i=$i' class='btn btn-danger'>" . $i . "</a>";
        } else {
            echo "<a href='?amount=$link_count&i=$i' class='btn btn-dark'>" . $i . "</a>";
        }
    }

    if (
        array_key_exists('i', $_GET) &&
        is_numeric($_GET['i']) &&
        $_GET['i'] != ''
    ) {
        $link =  $_GET['i'];
        if ($link % 3 == 0) {
            echo "Jūs uzklikšķinājāt uz $link";
        }
    }



    ?>
</div>