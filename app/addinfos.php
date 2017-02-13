<?php

class addInfo {

  public $name;
  public $sim;
  public $email;
  public $dob;
  public $office;
  public $phoneext;

  public $onames = array();
  public $oprojects = array();
  public $osupervisors = array();
  public $osupervisors1 = array();
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

 if (isset($x['osuper1'])) {
  foreach ($x['osuper1'] as $osupervisor1)
  {
    $this->osupervisors1[] = $osupervisor1;
  }
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


  static public function loadPeopleXML()
    {
      $xml = simplexml_load_file('AFAM/peopletest.xml');
      //$a = new SimpleXMLElement($xml);
          return $xml;
    }

static public function reformat($xmlFile)

{
  //$xmlFile = 'peopletest.xml';
if( !file_exists($xmlFile) ) die('Le document n\'existe pas: ' . $xmlFile);
else
{
  $dom = new DOMDocument('1.0');
  $dom->preserveWhiteSpace = false;
  $dom->formatOutput = true;
  $dl = @$dom->load($xmlFile); // remove error control operator (@) to print any error message generated while loading.
  if ( !$dl ) die('Erreur lors de la sauvegarde du document: ' . $xmlFile);
  $dom->save($xmlFile);
}
}

  public function addPeople ($a = 'AFAM/peopletest.xml')
  {


    error_reporting(0);
    $xml = new DOMDocument( '1.0');
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = TRUE;

    $xml = simplexml_load_file($a);
  //  $xml->loadXML($simpleXml->asXML());


    $deb = $xml->addChild('person');
      $deb->addChild('sim', $this->sim);
      $deb->addChild('name', $this->name);
      $deb->addChild('email', $this->email);
      $deb->addChild('dob', $this->dob);
      $deb->addChild('office', $this->office);
      $deb->addChild('phoneext', $this->phoneext);

for($y=0; $y<count($this->onames); ++$y)
{
      $occ= $deb->addChild('occupation');
        $occ->addChild('name', $this->onames[$y]);
        $occ->addChild('project', $this->oprojects[$y]);
        $occ->addChild('supervisor', $this->osupervisors[$y]);
        $occ->addChild('supervisor', $this->osupervisors1[$y]);
        $occ->addChild('start', $this->ostarts[$y]);
        $occ->addChild('end', $this->oends[$y]);
}

for($i=0; $i<count($this->gnames); ++$i)
{
  $grp = $deb->addChild('group');
    $grp->addChild('name', $this->gnames[$i]);
    $grp->addChild('start', $this->gstarts[$i]);
    $grp->addChild('end', $this->gends[$i]);

}

    $xml->asXML($a);
    self::reformat($a);
    //print_r($osupervisors);

  }








}









 ?>
