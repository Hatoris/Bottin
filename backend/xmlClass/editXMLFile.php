<?php

namespace backend\xmlClass;

class editXMLFile{



  private $pathtoxml;

  public function __construct(setXMLFile $pathtoxml) {
    $this->pathtoxml = $pathtoxml;
  }

  public function reformat()
  {
    $xmlFile = end(explode( "/" , $this->pathtoxml->pathtoxml));//$this->pathtoxml->pathtoxml;
    var_dump($xmlFile);
    var_dump(file_exists($xmlFile));
  if(!file_exists($xmlFile)) die('Document do not exist: ' . $xmlFile);
  else
  {
    $dom = new \DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dl = @$dom->load($xmlFile); // remove error control operator (@) to print any error message generated while loading.
    if ( !$dl ) die('Error when saving the document: ' . $xmlFile);
    $dom->save($xmlFile);
    //echo " $xmlFile has been save properly !";
  }
}








}


 ?>
