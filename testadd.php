<?php

require_once("app/addinfos.php");

if (isset($_POST['name'])) {


  $add = new addInfo($_POST);
  $add->addPeople('peopletest.xml');
  echo "Success";


}

else {
  echo "Error";
}

//&& p['sim'] && p['email']
 ?>
