<?php

require_once("app/modify.php");

    if(isset($_POST)) {

        $modify = new modifyInfo($_POST);
        $u = $modify -> modifyPeople();
        echo json_encode($u);exit;
        //$data['status'] = 'Success';
        //$data['name'] = $u;
        /*echo json_encode($data);exit;
        echo '<ul>' ;
        foreach ($u as $key => $value)
        {
            echo "<li>" . $key . " = " . $value . "</li>" ;
        }
         echo '</ul>' ;
         */
        //$t = print_r($_POST);
        //echo '<div class="alert alert-success">' . print_r($_POST) . "</div>";

    }

    else {
        echo "il y a un probleme";

    }


 ?>
