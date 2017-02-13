<?php

require_once( "DIC\DIContainer.php");
require 'xmlClass\setXMLFile.php';
require 'xmlClass\editXMLfile.php';
//require "DIC\Model.php";

$dic = new \backend\DIC\DIContainer();

$dic->set('backend\xmlClass\setXMLFile', function (){
  return new backend\xmlClass\setXMLFile("http://localhost/botin/backend/peopletest.xml");
});

$dic->set('backend\xmlClass\editXMLFile', function () use ($dic){
  return new backend\xmlClass\editXMLFile($dic->get('backend\xmlClass\setXMLFile'));
});

$readXML = $dic->get('backend\xmlClass\setXMLFile')->read();
//var_dump($readXML);
$saveXML = $dic->get('backend\xmlClass\editXMLFile');
var_dump($saveXML->reformat());








/*()
$dic->set('setXMLFile', function(){
  return new xmlClass\setXMLFile('http://localhost/botin/peopletest.xml');
});
*/
//$xmlFile1 = new backend\xmlClass\setXMLFile("http://localhost/botin/peopletest.xml");
//$dic->setInstance($xmlFile1);
//$readxml = new backend\xmlClass\readXMLFile($dic->get('backend\xmlClass\setXMLFile'));
//$dic->setInstance($readxml);
//var_dump($a->read()->person);

/*
$dic->set('Model', function() use ($dic){
  return new Model($dic->get('Connection'));

});
*/




 ?>
