<?php

require_once("app/addinfos.php");

if (isset($_POST['name'])) {


  $add = new addInfo($_POST);
  $add->addPeople('peopletest.xml');
  $data['status'] = 'Success';
  $data['name'] = $_POST['name'];
  echo json_encode($data);exit;


}

else {
  echo "Error";
}

//&& p['sim'] && p['email']
 ?>
