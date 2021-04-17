<?php
include "head.php";
$page = '42_link';

include "DataManager.php";
$manager = new DataManager('42_data.json');

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
            <input id="link-amount" name="amount" type="number" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-info">submit</button>
        </div>
    </form>

    <?php
    if (array_key_exists('amount', $_GET)) {
        $amount = (int) $_GET['amount'];
    } else {
        $amount = $manager->get('amount', 0);
    }
    if ($amount == '') {
        $amount = 42;
    }

    if (array_key_exists('next', $_GET)) {
        $amount++;
    }
    if (array_key_exists('prev', $_GET)) {
        $amount--;
    }
    $manager->save('amount', 0, $amount);

    $output = '';
    if (array_key_exists('id', $_GET)) {
        $id = (int) $_GET['id'];

        if ($id % 3 === 0) {
            $output .= "ID: " . $id;


            //START 5 uzd
            $link_value = $manager->get('links', $id);

            if ($link_value === '') {
                $link_value = $id;
            }
            $manager->save('links', $id, ++$link_value);

            //END 5 uzd
        }
    }




    for ($i = 1; $i <= $amount; $i++) {
        $value = $manager->get('links', $i);
        if ($value === '') {
            $value = $i;
        }
        $class_name = ($i % 6 === 0) ? 'btn-danger' : 'btn-dark';
        echo "<a href='?id=$i' class='btn $class_name'>$value</a>";
    }

    echo "<a href='?next' class='btn btn-success'>+</a>";
    echo "<a href='?prev' class='btn btn-success'>-</a>";
    echo $output;

    ?>
</div>