<?php
//============================== Load config 

$loadHelper = [
  'Function',
  'Input',
  'DB',
  'Pagination',
  'Redirect',
  'Session',
  'Validator',
  'Auth'
];

$posUrl =  strpos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",'admin');

if($posUrl != null)
{
  include('../../config/Config.php');
  include('../../vendor/autoload.php');

  foreach($loadHelper as $item){
      include("../../helper/$item.php");
  }
}
else{
  include('./config/Config.php');
  foreach($loadHelper as $item){
      include("./helper/$item.php");
  }
}

$DB = new DB();


