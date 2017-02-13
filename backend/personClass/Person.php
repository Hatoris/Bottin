<?php
namespace backend\personClass;

class Person{

  public $name;
  public $sim;
  public $email;
  public $dob;
  public $office;
  public $phoneext;

  public $onames = [];
  public $oprojects = [];
  public $osupervisors = [];
  public $osupervisors1 = [];
  public $ostarts = [];
  public $oends = [];

  public $gnames = [];
  public $gstarts = [];
  public $gends = [];


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



















}







?>
