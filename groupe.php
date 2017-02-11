<?php

require_once('app/groupes.php');
require_once('app/appinformations.php');


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













 ?>
