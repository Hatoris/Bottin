<?php

/*
  Class used to modify person infos already writen in the xml file.

*/
require_once('appinformations.php');
class modifyInfo {



static public function callModify($name) {
  //error_reporting(0);
          $z=0;
          $u=0;
              $info = getInfo::callPeopleXML();

                foreach($info->person as $v) {
                $aa = getInfo::Compare($name, $v->name);
                $ab = getInfo::Compare($name, $v->sim);
                $ac = getInfo::Compare($name, $v->email);
                $y = $aa + $ab + $ac;
                 //     echo $u . " => " . $y . "</br>";

                if ($y >= 1) {
                    $people = $info->person[$u];
                    echo
                    $people->name . "</br>" .
                    $people->sim . "</br>" .
                    $people->email . "</br>" .
                    $people->dob . "</br>" .
                    $people->office . "</br>" .
                    $people->phoneext;

                    foreach ($people->occupation as $occ) {
                      echo
                      $occ->name . "</br>" .
                      $occ->project . "</br>" .
                      $occ->supervisor . "</br>" .
                      $occ->start . "</br>" .
                      $occ->end;
                    }
                    foreach($people->group as $gro){
                      echo
                      $gro->name . "</br>" .
                      $gro->start . "</br>" .
                      $gro->end;
                    }

                  }
                  ++$u;
            }
      }


      static public function callModify2($name) {
        error_reporting(0);
                $z=0;
                $u=0;
                $xc = 1;
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
                     <div class="panel panel-primary" tag="modify"'. $xc .'" id="'. $xc .'">
                       <div class="panel-heading">
                         <strong> Modifier un membre a l\'AFAM </strong>
                       </div>
                       <div class="panel-body">
                         <form action="testadd.php" method="post" class="addpeople">
                           <div class="form-group">
                             <label for="name">Nom, prenom:</label>
                             <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                               <input type="text" class="form-control" name ="name" value="' . $people->name . '" id="name" placeholder="Nom, prenom">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="dob">Date de naissance:</label>
                             <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                               <input type="text" class="form-control date"  data-provide="datepicker" value="' . $people->dob . '" name ="dob" id="dob" placeholder="aaaa-mm-jj">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="sim">Numero SIM:</label>
                             <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
                               <input type="text" class="form-control" name ="sim" value="' . $people->sim . '" id="sim" placeholder="SIM">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="email">Courriel:</label>
                             <div class="input-group">
                               <span class="input-group-addon">@</span>
                               <input type="email" class="form-control" name ="email" value="' . $people->email . '" id="email" placeholder="xxxxx@umontreal.ca">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="office">Bureau N°:</label>
                             <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                               <input type="office" class="form-control" name ="office" value="' . $people->office . '" id="office" placeholder="4179">
                             </div>
                           </div>
                           <div class="form-group">
                             <label for="phoneext">Extension téléphone N°:</label>
                             <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                               <input type="phoneext" class="form-control" value="' . $people->phoneext . '" name ="phoneext" id="phoneext" placeholder="0407">
                             </div>
                           </div>
                           <h4><label for="name">Occupation</label></h4>
                           <div class="input_fields_wrap">
                             <button class="btn btn-info add_field_button_bis" id="'. $xc .'">Ajouter une occupation</button>
                             <div class="form-group" style="padding-top : 10px">
                               <table class="table table-hover" id="occupationsbis'. $xc .'">' ;
                                    $c = 1 ;
                                    foreach ($people->occupation as $occ) {

                                     echo '<tr id="c'. $c . '" class="occ">
                                      <td><label for="oname">Nom de l\'occupation:</label></br><input type="text" value="' . $occ->name . '" class="form-control" defaultvalue=" " id="oname" name="oname[1]">  </td>
                                      <td><label for="oproject">Nom du projet:</label></br><input type="text" value="' . $occ->project . '" class="form-control" defaultvalue=" " id="oproject" name="oproject[1]"></td>
                                      <td><label for="osuper">Nom du superviseur:</label></br><input type="text" value="' . $occ->superviser . '" class="form-control" defaultvalue=" " id="osuper" name="osuper[1]"></td>
                                      <td><label for="ostart">Date de debut:</label></br><input type="text" value="' . $occ->start . '" class="form-control" defaultvalue=" " id="ostart" name="ostart[1]"></td>
                                      <td><label for="oend">Date de fin:</label></br><input type="text" value="' . $occ->end . '" class="form-control" defaultvalue=" " id="oend" name="oend[1]"></td>
                                      <td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' . $c . '" style="align: center"></a></td>
                                     </tr>' ;
                                     ++$c;
                               }

                                echo '
                               </table>
                             </div>
                           </div>
                           <h4><label for="name">Groupe</label></h4>
                           <div class="input_fields_wrap_groupe_bis">
                             <button class="btn btn-info add_field_button_groupe_bis" id="'. $xc .'">Ajouter un groupe</button>
                             <div class="form-group" style="padding-top : 10px">
                               <table class="table table-hover" id="groupesbis'. $xc .'">';
                               $d = 1 ;
                               foreach ($people->group as $gro) {

                                 echo '<tr id="d'. $d . '" class="gro">
                                   <td><label for="gname">Nom du groupe:</label></br><input type="text" value="' . $gro->name . '" class="form-control" defaultvalue=" " id="gname" name="gname[1]"> </td>
                                   <td><label for="gstart">Date de debut:</label></br><input type="text" value="' . $occ->start . '" class="form-control" defaultvalue=" " id="gstart" name="gstart[1]"></td>
                                   <td><label for="gend">Date de fin:</label></br><input type="text" value="' . $occ->end . '" class="form-control" defaultvalue=" " id="gend" name="gend[1]"></td>
                                   <td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' . $d . '" style="align: center"></a></td>
                                 </tr>' ;
                                 ++$d;
                           }
                               echo '</table>
                             </div>
                           </div>
                           <div>
                             <button type="submit" id="submit" value="send" style="margin-top : 10px"class="btn btn-success submit"><span class="glyphicon glyphicon-floppy-save"></span> Enregister</button>
                           </div>
                           </form>
                         </div>
                       </div>' ;

                       ++$xc;

                          }
                          ++$u;
                        }

                  }




}

 ?>
