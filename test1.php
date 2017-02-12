<?php

require_once("app/addinfos.php");
$name = "florian, bernard";

if (isset($name)) {


  //$add = new addInfo($name);
  $u = addInfo::addPeople( 'peopletest.xml', $name);
  var_dump($u);
  if ($u == 'success') {
    $data['status'] = 'Success';
    $data['name'] = $name;
  }
  else {
    $data['status'] = 'error';
    $data['name'] = $u;
  }
  //$data['osup'] = $_POST['osuper'];
  echo json_encode($data);exit;


}



 ?>
