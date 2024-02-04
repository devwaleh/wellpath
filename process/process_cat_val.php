<?php

    require_once('../classes/Category.php');

    $cat = $_GET['catid'];
    $cat_id = $category->fetch_cat_unit($cat);
    $nill = " ";

    if ($cat_id) {
        echo $cat_id['cat_unit'];
    } else {
        echo $nill;
    }
    

?>