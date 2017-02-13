<?php
namespace backend\xmlClass;

/**
 * @var path to xml file used for the application
 */

class setXMLFile{

  public $pathtoxml;

  public function __construct($pathtoxml) {
    $this->pathtoxml = $pathtoxml;
  }

  public function read() {
    //include "$this->pathtoxml";
    $xmlFile = $this->pathtoxml;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"$xmlFile");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $contenu = curl_exec($curl);
        $xml = new \SimpleXMLElement($contenu);

        return $xml;
      }

}




?>
