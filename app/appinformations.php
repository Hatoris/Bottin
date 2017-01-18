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
        curl_setopt($curl, CURLOPT_URL,"http://localhost/afam/people.xml");
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
