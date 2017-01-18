<?php
require ('app\appinformations.php');


if (isset($_POST['name']))
  {
    $name = !empty($_POST['name']) ? $_POST['name'] : NULL;
    getInfo::Google($name);
  }



  if (isset($_POST['groupe']))
    {
      $groupe = $_POST['groupe'];
      $groupes [] = explode(",", $groupe);
      for($i=0;$i<count($groupes[0]); $i++)
      {
        $z = $groupes[0][$i];
        echo getInfo::callPeopleByGroup($z, $i);
      }

    }

    if (isset($_POST['groupee']))
      {
        $groupe = $_POST['groupee'];
        $groupes [] = explode(",", $groupe);
        for($i=0;$i<count($groupes[0]); $i++)
        {
          $z = $groupes[0][$i];
          echo getInfo::callPeopleByGroupEmail($z, $i);
        }

      }



 ?>
