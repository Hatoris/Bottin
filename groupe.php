<?php

require_once('app/groupes.php');
require_once('app/appinformations.php');
error_reporting(0);

$q = strtolower($_GET['term']);
$gro = groupes::getGroupes();
$res = array();
foreach($gro as $g)
{
    if(getInfo::compare($q , $g) == 1) {
        array_push($res, $g);
    }
}
  echo json_encode($res);
/*
    	echo json_encode($res);
      $res1 = '["' . implode('", "', $gro ) . '"]';


$gro = groupes::getGroupes();
$res1 = '["' . implode('", "', $gro ) . '"]';
$res = array();
foreach ($gro as $g)
{

  array_push($res, "$g");

}

//echo json_encode($res);
echo $res1;
*/











 ?>
