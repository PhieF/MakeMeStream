<?php
include "db.php";

if(!empty($_GET['uid'])){
	$query = "SELECT id, url 
		  FROM link WHERE (uid='".SQLite3::escapeString($_GET['uid'])."')";
	$results = $base->query($query);   
	$datapie = array();
	while ($row = $results->fetchArray()) {
		$datapie[] = array('id' => $row ['id'], 'url' => $row ['url']);
	}
	$query = "DELETE FROM link WHERE uid='".SQLite3::escapeString($_GET['uid'])."'";
	$base->query($query);
	header('Content-Type: application/json');
	$data = json_encode($datapie);
	echo $data;
}
else die("nope");


?>



