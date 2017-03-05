<?php

require_once( "DIC\DIContainer.php");
require 'xmlClass\setXMLFile.php';
require 'personClass\Person.php';
require 'view\viewPerson.php';
require 'view\viewGroup.php';
require 'DIC\Search.php';

/**
* Set XML file path activate
* http://afam-udem.ca:81/people.xml;
* http://localhost/botin/backend/peopletest.xml
**/
$dic = new \backend\DIC\DIContainer();
$dic->setFactory('backend\xmlClass\setXMLFile', function (){
  return new backend\xmlClass\setXMLFile("http://afam-udem.ca:81/people.xml");
});
$XML = $dic->get('backend\xmlClass\setXMLFile');
$XMLFile = $XML->file();


/**
* Return PersonCard for nodenumber selected
* First call search application in factory to return a new search for each call, use XML path
*
**/
$dic->setFactory('backend\DIC\Search', function() use ($XML){
  return new backend\DIC\Search($XML->read());
});
$search = $dic->get('backend\DIC\Search');
$dic->setFactory('backend\viewPerson', function(){
  return new \backend\viewPerson();
});
$viewPerson = $dic->get('backend\viewPerson');
$dic->setFactory('backend\viewGroup', function(){
  return new \backend\viewGroup();
});
$viewGroup = $dic->get('backend\viewGroup');


if (isset($_POST['nameSearch'])){
  $dataLookingFor = $_POST['nameSearch'];
  $personNodeNumber1 = $search->getNodeNumber('name', $dataLookingFor, TRUE);
  $personNodeNumber2 = $search->getNodeNumber('sim', $dataLookingFor, TRUE);
  $personNodeNumber = $search->getNodeNumber('email', $dataLookingFor, TRUE);
  if(isset($personNodeNumber1) || isset($personNodeNumber2) || isset($personNodeNumber3)){
    $viewPersonCard = $viewPerson->viewPersonCard($XML->read(), $personNodeNumber2);
    return $viewPersonCard;
  }
}

if (isset($_POST['groupe'])){
  $groupe = $_POST['groupe'];
  $groupes = explode(",", $groupe);
  $viewGroupPeople= $viewGroup->viewGroupPeople($XML->read(), $groupes);
  return $viewGroupPeople;
}

if (isset($_POST['groupee'])){
  $groupe = $_POST['groupee'];
  $groupes = explode(",", $groupe);
  $callPeopleByGroupEmail = $viewGroup->callPeopleByGroupEmail($XML->read(), $groupes);
  return $callPeopleByGroupEmail;
}


if (isset($_POST['groupeMerge'])){
  $groupe = $_POST['groupeMerge'];
  $groupes = explode(",", $groupe);
  $callPeopleByGroupEmail = $viewGroup->callPeopleByGroupEmail($XML->read(), $groupes, TRUE);
  return $callPeopleByGroupEmail;
}


if (isset($_GET['getGroupName']) and $_GET['getGroupName'] === "getName"){
  $getGroupName = $viewGroup->getGroupName($XML->read());
  echo json_encode($getGroupName);
}

// addPerson
if(isset($_POST['control'])) {
  if ($_POST['control'] === 'addPerson') {
    //var_dump($_POST);
    if (!isset($_POST['name'])){
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du nom</b>';
      echo json_encode($data);exit;
    }
    elseif (!isset($_POST['sim'])) {
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du numéro sim</b>';
      echo json_encode($data);exit;
    }
    elseif (!isset($_POST['email'])) {
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du courriel</b>';
      echo json_encode($data);exit;
    }
    else {
      $name = $_POST['name'];
      $sim = $_POST['sim'];
      $email = $_POST['email'];
      $personNodeNumber1 = $search->getNodeNumber('name', $name, TRUE);
      $personNodeNumber2 = $search->getNodeNumber('sim', $sim, TRUE);
      $personNodeNumber = $search->getNodeNumber('email', $email, TRUE);
      if($personNodeNumber != 'error'){
        $data['status'] = 'errorExist';
        $data['name'] = $_POST['name'];
        echo json_encode($data);exit;
      }
      else {
        $dic->setFactory('backend\personClass\Person', function() use ($_POST){
          return new backend\personClass\Person($_POST);
        });
        $addPerson = $dic->get('backend\personClass\Person');
        $addPerson->addPerson($XMLFile);
        $XML->reformatAndSave();
        $data['status'] = 'Success';
        $data['name'] = $_POST['name'];
        echo json_encode($data);exit;
      }
    }
  }
}

if (isset($_POST['nameSearchModify'])){
  $dataLookingFor = $_POST['nameSearchModify'];
  $personNodeNumber1 = $search->getNodeNumber('name', $dataLookingFor, TRUE);
  $personNodeNumber2 = $search->getNodeNumber('sim', $dataLookingFor, TRUE);
  $personNodeNumber = $search->getNodeNumber('email', $dataLookingFor, TRUE);
  if(isset($personNodeNumber1) || isset($personNodeNumber2) || isset($personNodeNumber3)){
    $viewPersonModify = $viewPerson->viewPersonModify($XML->read(), $personNodeNumber);
    if (isset($viewPersonModify)){
      return $viewPersonModify;
    }
    elseif($personNodeNumber == 'error') {
      $error = '<div class="alert alert-danger" role="alert" id="modifyvx1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span><strong> ' . $dataLookingFor . '</strong> n\'a pas été trouvé dans la base de donnée ! <a id="linkClose"  href="#" class="close" target="vx1">&times;</a></div>';
      echo $error;
    }
  }
}


if(isset($_POST['control'])) {
  if ($_POST['control'] === 'modifyPerson') {
    $dic->setFactory('backend\personClass\Person', function() use ($_POST){
      return new backend\personClass\Person($_POST);
    });
    $modifyPerson = $dic->get('backend\personClass\Person');
    $name = $_POST['name'];
    $personNodeNumber = $search->getNodeNumber('name', $name);
    foreach ($personNodeNumber as $person) {
      $personNodeNumber = $person;
    }
    $add = $modifyPerson->modifyPerson($XMLFile, $personNodeNumber);
    $save = $XML->reformatAndSave();
    if ($add == false) {
      $data['status'] = 'errorModify';
      $data['name'] = $name;
      echo json_encode($data);exit;
} elseif ($save == false) {
  $data['status'] = 'errorSave';
  $data['name'] = $name;
  echo json_encode($data);exit;
}    else {
      $data['status'] = 'Success';
      $data['name'] = $name;
      echo json_encode($data);exit;
    }
  }
}


?>
