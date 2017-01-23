<?php

    require_once('app\modify.php');
    if(isset($_POST)) {
        $t = modifyInfo::callModify2($_POST['name']);
        echo $t;
        //print_r($_POST['name']);
        //echo $_POST['name'];
    }

    else {
        echo "il y a un probleme";

    }


 ?>
