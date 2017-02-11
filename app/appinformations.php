<?php

/* Ceci est le fichier contenant la classe permetant d'obtenir les infos du fichier xml
 * Avant de l'utiliserr v/rifier que l'adresse en ligne 20 pointe bien vers le bon fichier
 * (http://afam-udem.ca:81/people.xml)
 *LA classe permet de recuperer les infos dans le fichier xml, mais egaelement de comparer les valeurs selon les
 *la valeur d<entre
*/




class getInfo {


/*Call informations for ALL PEOPLE of AFAM
*/



    var $data;


    function __construct($data){
        $this->data=$data;

    }

    static public function Compare($name, $name1)
    {
    require_once('app\smith.php');

          $y = new SmithWatermanGotoh();
          $t= strval(strtolower($name1));
          $y= $y->compare(strval(strtolower($name)), $t);
          if ($y == 1)
        return $y;
     }

    static public function callPeopleXML()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"http://localhost/botin/peopletest.xml");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $contenu = curl_exec($curl);
        $xml = new SimpleXMLElement($contenu);

        return $xml;
    }

    static public function callPeopleByNode($name, $node, $nodeV )
    {
        $i = 0;
        if ($node == '')
            {
                foreach(self::callPeopleXML()->person as $v){
                    $v = $v->$nodeV;
                $y = self::Compare($name, $v);
                if ($y == 1)
                    {
                        return $i;
                    }
                else
                    {
                      $i++;
                    }
                }
            }
        if ($node == 'group')
            {
                foreach(self::callPeopleXML()->person as $v){
                    $v = $v->group->$nodeV;
                $y = self::Compare($name, $v);
                var_dump($v);

                if ($y == 1)
                    {
                        echo $v . "</br>";
                        echo $i . "</br>";
                    }
                else
                    {
                      $i++;
                    }
                }
            }
        if ($node == 'occupation')
            {
                foreach(self::callPeopleXML()->person as $v){
                    $v = $v->occupation->$nodeV;
                $y = self::Compare($name, $v);
                var_dump($v);

                if ($y == 1)
                    {
                        echo $v . "</br>";
                        echo $i . "</br>";
                    }
                else
                    {
                      $i++;
                    }
                }
            }
         }





     static public function callPeopleData($data)
     {
         foreach(self::callPeopleXML()->person as $v){
        //var_dump($data);
         //var_dump($v->$data);
                      echo "<ul>" .
                      "<li>"  . "<strong>"  . $v->name . "</strong>" . "</li>" .
                      "<ul>" .
                      "<li>" . $v->$data . "</li>" .
                      "</ul>" . "</ul>";
                        }
         }

         static public function callPeoppleDataFEmail($group)
         {
             foreach(self::callPeopleXML()->person as $v)
             {
                 $z = self::Compare($group, $v->group->name);
                 if ($z ==1)
                     {
                         $groupname[] = $v->group->name;
                         $name[] = $v->name;
                         $sim[] = $v->sim;
                         $email[] = $v ->email;
                     }
             }
             $groupbis = array_unique($groupname);
            foreach ($groupbis as $groupbi) {
             echo "<strong>". $groupbi . "</strong>" . " " ;
         }

            echo "</br>";

             for ($i=0;$i<count($name);$i++) {
                 echo $email[$i] . "; " ;
             }
         }



         /*Call informations for GROUP of AFAM
         */

         static public function callPeopleByGroup($group, $a){
             $x = 'a' . $a;
             require_once('app/date.php');
             foreach(self::callPeopleXML()->person as $v)
            {
                foreach ($v->group as $ux) {
                    if ($ux->name == $group)
                        {
                            $t = $ux->end;
                            $d = Date::stealWork($t);
                            if ($d == 1)
                            {
                                $format [] = '<span class="glyphicon glyphicon-ok"></span>';
                            }
                            else if ($d == 0)
                            {
                                $format [] = '<span class="glyphicon glyphicon-remove"></span>';
                            }
                            $name[] = $v->name;
                            $sim[] = $v->sim;
                            $email[] = $v ->email;
                            $start[] = $ux->start;
                            $end [] = $ux->end;
                        }
                       }
                    }
                    echo

                    '<div id="myAlert' . $x . '" class="panel panel-info" target="' . $x . '">
                           <div class="panel-heading">
                            <h5> <strong>' . " $group" . '</strong> <a id="linkClose"  href="#" class="close" target="' . $x . '">&times;</a></h5>'.
                           '</div>

                           <div class="panel-body table-responsive">
                    <table class="table table-hover">
                           <thead>
                             <tr>
                               <th>Nom</th>
                               <th>SIM</th>
                               <th>Courriel</th>
                               <th>Debut</th>
                               <th>Fin</th>
                               <th style="text-align: center">Present</th>
                             </tr>
                           </thead>
                           <tbody>';
                for ($i=0;$i<count($name);$i++) {

                    echo
                           '<tr>
                               <td>' . $name[$i] . '</td>
                               <td>' . $sim[$i] . '</td>
                               <td>' . $email[$i] . '</td>
                               <td>' . $start[$i] . '</td>
                               <td>' . $end[$i] . '</td>
                               <td style="text-align: center">' . $format[$i] . '</td>
                           </tr>';
                }
                echo '</tbody>
              </table>
              </div>
              </div>';
            }

            static public function callModify($name) {
                  //error_reporting(0);
                          $z=0;
                          $u=0;
                          $xc = 1;
                          $superm = array ();
                              $info = getInfo::callPeopleXML();

                                foreach($info->person as $v) {
                                $aa = getInfo::Compare($name, $v->name);
                                $ab = getInfo::Compare($name, $v->sim);
                                $ac = getInfo::Compare($name, $v->email);
                                $y = $aa + $ab + $ac;
                                 //echo $u . " => " . $y . "</br>";

                                if ($y >= 1) {
                                     $people = $info->person[$u];

                      echo
                          '
                               <div class="panel panel-primary" target="' . $xc . '" tag="modify"'. $xc .'" id="'. $xc .'">
                                 <div class="panel-heading">
                                   <strong> Modifier un membre a l\'AFAM </strong>
                                   <a id="linkClose"  href="#" class="close" target="' . $xc . '">&times;</a>
                                 </div>
                                 <div class="panel-body" id="' . $xc . '">
                                   <form class="modifypeople' . $xc . '" action="" method="POST" id="' . $xc . '">
                                     <div class="form-group">
                                       <label for="name">Nom, prenom:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                         <input type="text" defaultvalue=" " class="form-control" name ="name" value="' . $people->name . '" id="name" placeholder="Nom, prenom">
                                       </div>
                                     </div>
                                     <div class="form-group">
                                       <label for="dob">Date de naissance:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                         <input type="text" defaultvalue=" " class="form-control date"  data-provide="datepicker" value="' . $people->dob . '" name ="dob" id="dob" placeholder="aaaa-mm-jj">
                                       </div>
                                     </div>
                                     <div class="form-group">
                                       <label for="sim">Numero SIM:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
                                         <input type="text" defaultvalue=" " class="form-control" name ="sim" value="' . $people->sim . '" id="sim" placeholder="SIM">
                                       </div>
                                     </div>
                                     <div class="form-group">
                                       <label for="email">Courriel:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon">@</span>
                                         <input type="email" defaultvalue=" " class="form-control" name ="email" value="' . $people->email . '" id="email" placeholder="xxxxx@umontreal.ca">
                                       </div>
                                     </div>
                                     <div class="form-group">
                                       <label for="office">Bureau N°:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                         <input type="office" defaultvalue=" " class="form-control" name ="office" value="' . $people->office . '" id="office" placeholder="4179">
                                       </div>
                                     </div>
                                     <div class="form-group">
                                       <label for="phoneext">Extension téléphone N°:</label>
                                       <div class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                         <input type="phoneext" defaultvalue=" " class="form-control" value="' . $people->phoneext . '" name ="phoneext" id="phoneext" placeholder="0407">
                                       </div>
                                     </div>
                                     <h4><label for="name">Occupation</label></h4>
                                     <div class="input_fields_wrap">
                                       <button class="btn btn-info add_field_button_bis" id="'. $xc .'">Ajouter une occupation</button>
                                       <div class="form-group" style="padding-top : 10px">
                                        <div class="table-responsive">
                                         <table class="table" id="occupationsbis'. $xc .'">' ;
                                              $c = 0 ;
                                              foreach ($people->occupation as $occ) {


                                               echo '<tr id="c'. $c . '" class="occ">
                                                <td><label for="oname">Nom de l\'occupation:</label></br><input defaultvalue=" " type="text" value="' . $occ->name . '" class="form-control" defaultvalue=" " id="oname" name="oname['. $c . ']">  </td>
                                                <td><label for="oproject">Nom du projet:</label></br><input defaultvalue=" " type="text" value="' . $occ->project . '" class="form-control" defaultvalue=" " id="oproject" name="oproject['. $c . ']"></td>
                                                <td><table><td id="bb'. $c .'"><label for="osuper">Nom du superviseur: </label><a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="'. $c . '" style="align: center"></a></br><input defaultvalue=" " type="text" value="' .  $occ->supervisor[0]  . '" class="form-control" defaultvalue=" " id="osuper" name="osuper[' . $c . ']"></td><table><tr id="g'. $c .'"><td><input type="text" class="form-control col-md-1 osup1" content="width=80%" defaultvalue=" " value="'. $occ->supervisor[1]  . '" id="" name="osuper1['. $c . ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="'. $c .'" style="align: center"></a></td></tr></table></td>
                                                <td><label for="ostart">Date de debut:</label></br><input defaultvalue=" " type="text" value="' . $occ->start . '" class="form-control" defaultvalue=" " id="ostart" name="ostart['. $c . ']"></td>
                                                <td><label for="oend">Date de fin:</label></br><input defaultvalue=" " type="text" value="' . $occ->end . '" class="form-control" defaultvalue=" " id="oend" name="oend['. $c . ']"></td>
                                                <td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' . $c . '" style="align: center"></a></td>
                                               </tr>' ;
                                               ++$c;
                                         }

                                          echo '
                                         </table>
                                         </div>
                                       </div>
                                     </div>
                                     <h4><label for="name">Groupe</label></h4>
                                     <div class="input_fields_wrap_groupe_bis">
                                       <button class="btn btn-info add_field_button_groupe_bis" id="'. $xc .'">Ajouter un groupe</button>
                                       <div class="form-group" style="padding-top : 10px">
                                         <table class="table table-hover" id="groupesbis'. $xc .'">';
                                         $d = 0 ;
                                         foreach ($people->group as $gro) {

                                           echo '<tr id="d'. $d . '" class="gro">
                                             <td><label for="gname">Nom du groupe:</label></br><input type="text" defaultvalue=" " value="' . $gro->name . '" class="form-control" defaultvalue=" " id="gname" name="gname[' . $d . ']"> </td>
                                             <td><label for="gstart">Date de debut:</label></br><input type="text" defaultvalue=" " value="' . $gro->start . '" class="form-control" defaultvalue=" " id="gstart" name="gstart[' . $d . ']"></td>
                                             <td><label for="gend">Date de fin:</label></br><input type="text" defaultvalue=" " value="' . $gro->end . '" class="form-control" defaultvalue=" " id="gend" name="gend[' . $d . ']"></td>
                                             <td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' . $d . '" style="align: center"></a></td>
                                           </tr>' ;
                                           ++$d;
                                     }
                                         echo '</table>
                                       </div>
                                     </div>
                                     <div>
                                       <button type="submit2" id="'. $xc .'" value="send" style="margin-top : 10px"class="btn btn-warning submit2"><span class="glyphicon glyphicon glyphicon-paste"></span> Modifier</button>
                                     </div>
                                      <span class="results2" id="'. $xc .'"></span>
                                     </form>
                                   </div>
                                 </div>' ;

                                 ++$xc;

                                    }
                                    ++$u;
                                  }

                            }


             /*Call informations for ONE person of AFAM
             */


            static public function Google($name){
                error_reporting(0);
                $z=0;


                      foreach(self::callPeopleXML()->person as $v){
                      $aa = self::Compare($name, $v->name);
                      $ab = self::Compare($name, $v->sim);
                      $ac = self::Compare($name, $v->email);
                      $y = $aa + $ab + $ac;
                if ($y >= 1 )
                        {
                            require_once('app/date.php');
                            $date = Date::lessYears($v->dob);
                            $date = utf8_encode($date);
                            echo

                            '<div id="myAlert' . $z .'" class="panel panel-info" target="' . $z . '">
                            <div class="panel-heading">
                             <h5> <strong>' . " $v->name" . '</strong> <a id="linkClose"  href="#" class="close" target="' . $z . '">&times;</a></h5>'.
                            '</div>
                            <div class="panel-body">
                            <div class="container">
                            <div class="row">
                            <h4>
                            <label>Informations generales</label>
                            </h4>
                            </div>
                            <div class="row">
                            <label>
                            Numero SIM :
                            </label>' .
                            " $v->sim" .
                            '</div>
                            <div class="row">
                            <label>
                            Date de naissance:
                            </label>' .
                            " $date" .
                            '</div>
                            <div class="row">
                            <label>
                            Courriel:
                            </label>' .
                            " $v->email" .
                            '</div>
                            <div class="row">
                            <h4>
                            <label>Occupation</label>
                            </h4>
                            </div>';

                            foreach ($v->occupation->supervisor as $sup) {
                            echo

                                '<div class="row">
                                <label>
                                  Superviseur:
                                </label>' .
                                 " $sup" .
                            '</div>';
                            }


                        echo
                            '<div class="row">
                              <label>Fonction :</label>
                           </div>
                              <div class="col-sm-11" role="complementary">
                              <div class="panel-body table-responsive">
                                  <table class="table table-striped">
                                    <tr>
                                  <th class="col-md-3">
                                    Nom de la fonction
                                  </th>
                                  <th class="col-md-3">
                                    Debut
                                  </td>
                                  <th class="col-md-3">
                                    Fin
                                  </th>
                                </tr>';


                                foreach ($v->occupation as $occ) {
                                  echo
                                  '<tr>
                                      <td>' .
                                       $occ->name .
                                      "</td>
                                      <td>" .
                                        $occ->start .
                                      "</td>
                                      <td>" .
                                          $occ->end .
                                      '</td>
                                  </tr>';
                                  }
                        echo
                            '</table> </div>
                            <div class="row">
                             <label>Projets :</label>
                             </div>

                            <div class="panel-body table-responsive">
                            <table class="table table-striped">
                              <tr>
                                <th class="col-md-3">
                                  Nom du projet
                                </th>
                                <th class="col-md-3">
                                  Debut
                                </td>
                                <th class="col-md-3">
                                  Fin
                                </th>
                              </tr>';

                              foreach ($v->occupation as $projects) {
                                  echo
                                  "<tr>
                                  <td>" .
                                  $projects->project .
                                "</td>" .
                                "<td>" .
                                  $projects->start .
                                "</td>" .
                                "<td>" .
                                $projects->end .
                                "</td>
                              </tr>";
                          }
                          echo
                            '</table>
                                </div>
                                <div class="row">
                                  <h4>
                                <label>Groupe</label>
                                  </h4>
                                </div>
                                <div class="panel-body table-responsive">
                                    <table class="table table-striped">
                                      <tr>
                                    <th class="col-md-3">
                                      Nom du groupe
                                    </th>
                                    <th class="col-md-3">
                                      Debut
                                    </td>
                                    <th class="col-md-3">
                                      Fin
                                    </th>
                                  </tr>';


                                foreach ($v->group as $groups) {
                                echo
                                '<tr>
                                    <td>' .
                                     $groups->name .
                                    "</td>
                                    <td>" .
                                      $groups->start .
                                    "</td>
                                    <td>" .
                                        $groups->end .
                                    '</td>
                                </tr>';
                                }
                                echo
                            "</table>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>" ;

                            $z++;
                        }



                          }

                          if ($z==0){
                              return 0;
                              /*
                              echo '<div class="alert alert-danger" role="alert"> <strong>' . $name . '</strong> , n\'existe pas dans we people of AFAM!</div>';
                              */
                          }
                      }

                      static public function getGroupeName()
        {
            $groupes = array();
            foreach(self::callPeopleXML()->person as $v)
            {
                foreach ($v->group as $g)
                {
                    $groupes [] = $g->name;
                }
            }
            $groupes = array_unique($groupes);
            sort($groupes);
            return $groupes;

        }

        static public function callPeopleByGroupEmail($group, $a){
            error_reporting(0);
            $x = 'b' . $a;
            require_once('app/date.php');
                    foreach(self::callPeopleXML()->person as $v)
                    {
                        foreach ($v->group as $ux) {
                            if ($ux->name == $group)
                                {
                                    $t = $ux->end;
                                    $d = Date::stealWork($t);
                                    if ($d == 1)
                                    {
                                        $name[] = $v->name;
                                        $sim[] = $v->sim;
                                        $email[] = $v ->email;
                                        $start[] = $ux->start;
                                        $end [] = $ux->end;
                                    }
                                }
                               }
                            }
                            echo

                            '<div id="myAlert' . $x . '" class="panel panel-info" target="' . $x . '">
                                   <div class="panel-heading">
                                    <h5> <strong>' . " $group" . ' Courriel</strong> <a id="linkClose"  href="#" class="close" target="' . $x . '">&times;</a></h5>
                                   </div>
                                   <div class="panel-body" id="courriel' . $x . '">';
                                   if ($name == null)
                                    {
                                        echo "Plus personne ne travail dans ce groupe";
                                    }
                            else {
                        for ($i=0;$i<count($name);$i++) {

                            echo $email[$i] . '; ' ;
                        }
                    }
                        echo '
                        </div>
                        <div class="panel-footer">
                        <button class="btn btn-info" data-clipboard-action="copy" data-clipboard-target="#courriel'. $x . '"><span class="glyphicon glyphicon-copy"></span> Copier</button>
                        </div>
                        </div>
                        ';




                    }










}



?>
