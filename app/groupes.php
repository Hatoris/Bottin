<?php
  require_once('appinformations.php');

class groupes {


  private static $groupes = NULL;

  private function __construct() {}

  private function __clone () {}

  public static function getGroupes () {
    if (!isset(self::$groupes)) {
      foreach(getInfo::callPeopleXML()->person as $v)
      {
          foreach ($v->group as $g)
          {
              $groupes [] = $g->name;
          }
      }
      $groupes = array_unique($groupes);
      sort($groupes);
      $g = json_decode(json_encode($groupes), true);
       //var_dump($g);
       foreach ($g as $t) {
           foreach ($t as $b) {
               $u[] = utf8_encode($b);
           }
       }
      self::$groupes = $u;
    }
    return self::$groupes ;
  }
}





 ?>
