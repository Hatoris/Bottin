<?php

class Model {

  /**
   * @var Connection
   */

   private $xmlFile;
   private $uniqueid;

   public function __construct(xmlFile $xmlFile){
     $this->xmlFile = $xmlFile;
     $this->uniqueid = uniqid();
   }


}




 ?>
