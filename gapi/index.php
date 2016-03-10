<?php
require_once 'gapi.class.php';
$ga = new gapi("foodtalk@foodtalk-k325.iam.gserviceaccount.com", "key.p12");


$ga->requestReportData(99009092,array('date'),array('pageviews','visits'),array('date'),null,date('Y-m-d',strtotime('2 week ago')),date('Y-m-d'),1,15);
$data = array();
foreach($ga->getResults() as $result)
{
	//$list[] = array('id' => substr_replace(substr($result->getDate(),4), "-", 2, -2), 'name' => $result->getVisits());
	// $data = new stdClass();
	// $data->id=substr_replace(substr($result->getDate(),4), "-", 2, -2);
 //    $data->name=$result->getVisits();
 //    array_push($list,$data);
    array_push($data, substr_replace(substr($result->getDate(),4), "-", 2, -2));
    array_push($data, $result->getVisits());
}

$ga->requestReportData(99025528,array('date'),array('pageviews','visits'),array('date'),null,date('Y-m-d',strtotime('2 week ago')),date('Y-m-d'),1,15);

foreach($ga->getResults() as $result)
{
	//$list[] = array('id' => substr_replace(substr($result->getDate(),4), "-", 2, -2), 'name' => $result->getVisits());
	// $list = new stdClass();
	// $list->id=substr_replace(substr($result->getDate(),4), "-", 2, -2);
 //    $list->name=$result->getVisits();
 //    array_push($list,$list);
    array_push($data, substr_replace(substr($result->getDate(),4), "-", 2, -2));
    array_push($data, $result->getVisits());
}
 //, "-", 2, -2
  //   echo json_encode($list);
$result = array();
$j = 31;
$k = 0;
for ($i = 0; $i <= 29 ; $i= $i + 2) { 
	$result[$k]= $data[$i];
	$k++;
	$result[$k]= $data[$i+1];
	$k++;
	$result[$k]= $data[$j];
	$k++;
	$j = $j +2;
}

  echo json_encode($result);
?>