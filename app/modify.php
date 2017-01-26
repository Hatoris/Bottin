<?php

/*
  Class used to modify person infos already writen in the xml file.

*/
require_once('appinformations.php');
class modifyInfo {

      public $name;
      public $sim;
      public $email;
      public $dob;
      public $office;
      public $phoneext;

      public $onames = array();
      public $oprojects = array();
      public $osupervisors = array();
      public $ostarts = array();
      public $oends = array();

      public $gnames = array();
      public $gstarts = array();
      public $gends = array();

      function __construct($x)
      {
      //genrales informations

      $this->name = $x['name'] ;
      $this->sim = $x['sim'] ;
      $this->email = $x['email'] ;
      $this->dob = $x['dob'] ;
      $this->office = $x['office'] ;
      $this->phoneext = $x['phoneext'] ;

      //occupation informations

      foreach ($x['oname'] as $oname)
      {
      $this->onames[] = $oname;
      }

      foreach ($x['oproject'] as $oproject)
      {
      $this->oprojects[] = $oproject;
      }

      foreach ($x['osuper'] as $osupervisor)
      {
      $this->osupervisors[] = $osupervisor;
      }

      foreach ($x['ostart'] as $ostart)
      {
      $this->ostarts[] = $ostart;
      }

      foreach ($x['oend'] as $oend)
      {
      $this->oends[] = $oend;
      }

      //groupe informations

      foreach ($x['gname'] as $gname)
      {
      $this->gnames[] = $gname;
      }

      foreach ($x['gstart'] as $gstart)
      {
      $this->gstarts[] = $gstart;
      }

      foreach ($x['gend'] as $gend)
      {
      $this->gends[] = $gend;
      }




      }







public function modifyPeople() {
  error_reporting(0);
          $z=0;
          $u=0;
              $info = getInfo::callPeopleXML();

                foreach($info->person as $v) {
                $aa = getInfo::Compare($v->name, $this->name);
                $ab = getInfo::Compare($v->sim, $this->sim);
                $ac = getInfo::Compare($v->email, $this->email);
                $y = $aa + $ab + $ac;
                 //     echo $u . " => " . $y . "</br>";

                if ($y >= 1) {
                    $people = $info->person[$u];
                    $du = array (
                    $people->name => $this->name,
                    $people->sim => $this->sim,
                    $people->email => $this->email,
                    $people->dob => $this->dob,
                    $people->office => $this->office,
                    $people->phoneext => $this->phoneext,
              );

                    if (count($people->occupation) < count($this->onames)){
                          $rxd = count($this->onames);
                    }
                    else {
                          $rxd = count($people->occupation);
                    };
                    for($mu=0; $mu<count($rxd); ++$mu) {
                          $occ = $people->occupation[$mu];
                          $dv = array (
                          $occ->name => $this->onames[$mu],
                          $occ->project => $this->oprojects[$mu],
                          $occ->supervisor => $this->osupervisors[$mu],
                          $occ->start => $this->ostarts[$mu],
                          $occ->end => $this->oends[$mu]
                        );
                    }

                    if (count($people->group) < count($this->gnames)){
                          $rxt = count($this->gnames);
                    }
                    else {
                          $rxt = count($people->group);
                    };
                    for($mz=0; $mu<count($rxt); ++$mz) {
                          $gro = $people->occupation[$mz];
                          $dw = array (
                          $gro->name => $this->gnames[$mz],
                          $occ->start => $this->gstarts[$mz],
                          $occ->end => $this->gends[$mz]
                              );
                   }
                   return $du;

              //Now if difference between things add it to xml file or change it.
              //$du ; $dv ; $dw
              foreach ($du as $key => $value) {
                    if ($key != $value) {
                          //change node values
                          $key = $value;
                         ++$z;
                    }
              }
               foreach ($dv as $key => $value) {
                    if ($key != $value) {
                                //change node values
                         $key = $value;
                         ++$z;
                   }
             }
                foreach ($dw as $key => $value) {
                      if ($key != $value) {
                            //change node values
                         $key = $value;
                         ++$z;
                      }
                }
              }
              ++$u;
        }

        //return print_r($du);
        //return $z;
}
            /*foreach ($arr as $key => $value) {
    echo "Clé : $key; Valeur : $value<br />\n";
}*/
      }









 ?>
