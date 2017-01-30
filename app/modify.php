<?php

/*
  Class used to modify person infos already writen in the xml file.

*/
require_once('appinformations.php');
require_once('addinfos.php');
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
            //print_r($x);
      //genrales informations

      $this->name = trim($x['name']) ;
      $this->sim = trim($x['sim']) ;
      $this->email = trim($x['email']) ;
      $this->dob = trim($x['dob']) ;
      $this->office = trim($x['office']) ;
      $this->phoneext = trim($x['phoneext']) ;

      //occupation informations

      foreach ($x['oname'] as $oname)
      {
      $this->onames[] = trim($oname);
      }

      foreach ($x['oproject'] as $oproject)
      {
      $this->oprojects[] = trim($oproject);
      }

      foreach ($x['osuper'] as $osuper)
      {
      $this->osupervisors[] = trim($osuper);
      }

      foreach ($x['ostart'] as $ostart)
      {
      $this->ostarts[] = trim($ostart);
      }

      foreach ($x['oend'] as $oend)
      {
      $this->oends[] = trim($oend);
      }

      //groupe informations

      foreach ($x['gname'] as $gname)
      {
      $this->gnames[] = trim($gname);
      }

      foreach ($x['gstart'] as $gstart)
      {
      $this->gstarts[] = trim($gstart);
      }

      foreach ($x['gend'] as $gend)
      {
      $this->gends[] = trim($gend);
      }




      }





      public function modifyPeople($a) {
        //error_reporting(0);
                $z=0;
                $u=0;
                $modi = array();
                    //$info = getInfo::callPeopleXML();

                  $xml = new DOMDocument( '1.0');
                  $xml->preserveWhiteSpace = false;
                  $xml->formatOutput = TRUE;
                      $xml = simplexml_load_file($a);

                    //$xml1 = simplexml_load_string($a);
                    //$xml = new SimpleXMLElement($xml1);

                      foreach($xml->person as $v) {
                      $aa = getInfo::Compare($v->name, $this->name);
                      $ab = getInfo::Compare($v->sim, $this->sim);
                      $ac = getInfo::Compare($v->email, $this->email);
                      $y = $aa + $ab + $ac;
                       //     echo $u . " => " . $y . "</br>";
                       //print_r($this->oprojects) ;
                       //print_r($this->onames) ;
                      if ($y >= 1) {
                          $people = $xml->person[$u];
                         //print_r($people);
                         print_r($this->gends);

                          if ($people->name != $this->name) {
                                $r1 = !empty($this->name) ? $this->name : " " ;
                            $people->name = $r1;

                          }
                          elseif ($people->sim != $this->sim) {
                                $r2 = !empty($this->sim) ? $this->sim : " " ;
                            $people->sim = $r2;

                          }
                          elseif ($people->email != $this->email) {
                                $r3 = !empty($this->email) ? $this->email : " " ;
                            $people->email = $r3;

                          }
                          elseif ($people->dob != $this->dob) {
                                $r4 = !empty($this->dob) ? $this->dob : " " ;
                            $people->dob = $r4;

                          }
                          elseif ($people->office != $this->office) {
                                $r5 = !empty($this->office) ? $this->office : " " ;
                            $people->office = $r5;

                          }
                          elseif ($people->phoneext != $this->phoneext) {
                                $r6 = !empty($this->phoneext) ? $this->phoneext : " " ;
                            $people->phoneext = $r6;

                          }

                          $rxc = max(count($this->onames), count($this->oprojects), count($this->osupervisors), count($this->ostarts), count($this->oends));
                          $rxd = count($people->occupation);
                          $rxd2 = $rxd -1;
                         //print_r($rxd);
                         $ocr = array();
                          for($mu=0; $mu<=$rxd2; $mu++) {
                                $occ = $people->occupation[$mu];
                                $ocr[] = $occ;

                                if (!isset($this->onames[$mu]) && !isset($this->oprojects[$mu]) && !isset($this->osupervisors[$mu]) && !isset($this->ostarts[$mu]) && !isset($this->oends[$mu])) {
                                      unset($people->occupation[$mu]);
                                }
                                else {
                                if ($occ->name != $this->onames[$mu]){
                                      $mane = !empty($this->onames[$mu]) ? $this->onames[$mu] : " " ;
                                      $occ->name =  $mane;
                                  }

                                if ($occ->project != $this->oprojects[$mu]) {
                                      $prorect = !empty($this->oprojects[$mu]) ? $this->oprojects[$mu] : " " ;
                                      $occ->project = $prorect;
                                }
                                if ($occ->supervisor != $this->osupervisors[$mu]) {
                                      $pruv = !empty($this->osupervisors[$mu]) ? $this->osupervisors[$mu] : " " ;
                                      $occ->supervisor = $pruv;
                                }
                                if ($occ->start != $this->ostarts[$mu]) {
                                      $reat = !empty($this->ostarts[$mu]) ? $this->ostarts[$mu] : " " ;
                                      $occ->start = $reat ;
                                }
                                if ($occ->end != $this->oends[$mu]) {
                                    $rend = !empty($this->oends[$mu]) ? $this->oends[$mu] : " " ;
                                    $occ->end = $rend;
                                }
                              }
                          }

                          if ($rxc - $rxd > 0) {
                          $upp1 = self::myNumber($rxc);
                          for($la = $upp1; $la < $rxc ; $la++) {
                              $occupation = $people->addChild('occupation');
                              $named = !empty($this->onames[$la]) ? $this->onames[$la] : " ";
                              $occupation->addChild('name', $named);
                              $projectd = !empty($this->oprojects[$la]) ? $this->oprojects[$la] : " ";
                              $occupation->addChild('project', $projectd);
                              $supervisord = !empty($this->osupervisors[$la]) ? $this->osupervisors[$la] : " ";
                              $occupation->addChild('supervisor', $supervisord );
                              $startd = !empty($this->ostarts[$la]) ? $this->ostarts[$la] : " ";
                              $occupation->addChild('start', $startd );
                              $endd = !empty($this->oends[$la]) ? $this->oends[$la] : " ";
                              $occupation->addChild('end', $endd );
                          }
                    }


                          $rxe =  max(count($this->gnames), count($this->gstarts), count($this->gends));
                          $rxf = count($people->group);
                          $rxf2 = $rxf -1;

                          for($mz=0; $mz<=$rxf2; $mz++) {
                                $gro = $people->group[$mz];
                                if (!isset($this->gnames[$mz]) && !isset($this->gstarts[$mz]) && !isset($this->gends[$mz])) {
                                      unset($people->group[$mz]);
                                }
                                else {

                                if ($gro->name != $this->gnames[$mz]) {
                                      $x1 = !empty($this->gnames[$mz]) ? $this->gnames[$mz] : " " ;
                                  $gro->name = $x1;
                                }
                                if ($gro->start != $this->gstarts[$mz]) {
                                      $x2 = !empty($this->gstarts[$mz]) ? $this->gstarts[$mz] : " " ;
                                    $gro->start = $x2;
                                  }

                                if ($gro->end != $this->gends[$mz]) {
                                      $x3 = !empty($this->gends[$mz]) ? $this->gends[$mz] : " " ;
                                    $gro->end = $x3;
                                  }
                            }
                          }
                          //print_r($this->gnames);
                          if ($rxe-$rxf > 0) {
                          $up = self::myNumber($rxe);
                            for($lb = $up; $lb < $rxe ; $lb++) {
                                    $groupe = $people->addChild('group');
                                    $nameg = !empty($this->gnames[$lb]) ? $this->gnames[$lb] : " " ;
                                    //echo $nameg;
                                    $groupe->addChild('name', $nameg );
                                    $startg = !empty($this->gstarts[$lb]) ? $this->gstarts[$lb] : " " ;
                                    $groupe->addChild('start', $startg );
                                    $endg = !empty($this->gends[$lb]) ? $this->gends[$lb] : " " ;
                                    $groupe->addChild('end', $endg );

                                }
                          }

                                //print_r($xml);
                                $xml->saveXML($a);


                               }
                    ++$u;
              }
              echo "Success";



addInfo::reformat($a);
self::__destruct();
            }

            function myNumber($a) {
                  if ($a == 1) {
                        return 1;
                  }
                  else {
                        $a -= 1;
                        return $a;
                  }
            }


            function __destruct()
            {
            //destruction

            unset($this->name) ;
            unset($this->sim );
            unset($this->email );
            unset($this->dob) ;
            unset($this->office) ;
            unset($this->phoneext) ;
            unset($this->oname) ;
            unset($this->oprojects);
            unset($this->osupervisors);
            unset($this->ostarts);
            unset($this->oends);
            unset($this->gnames);
            unset($this->gstarts);
            unset($this->gends);
            }







}




















 ?>
