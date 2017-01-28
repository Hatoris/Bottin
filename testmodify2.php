<?php

require_once("app/modify.php");

    if(isset($_POST)) {



        $modify = new modifyInfo($_POST);
        $absd = $modify -> modifyPeople3('peopletest.xml');
              /*
        $add = new addInfo($_POST);
        $add->addPeople2('peopletest.xml', 2);
        $print = echo print_r($_POST);
        $data['status'] = 'Success';
        $data['name'] = $_POST['name'];
        $data['print'] = $print;
        echo json_encode($data);exit;
        */
        echo $absd;


    }

    else {
        echo "il y a un probleme";

    }


 ?>
