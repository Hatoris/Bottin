<?php

    require_once('app\appinformations.php');
    if(isset($_POST)) {
        $t = getInfo::callModify($_POST['name']);
        echo $t;
        //print_r($_POST['name']);
        //echo $_POST['name'];
    }

    else {
        echo "il y a un probleme";

    }


 ?>
