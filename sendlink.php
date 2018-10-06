<?php
include "db.php";

if(!empty($_POST['url']) AND !empty($_POST['uid'])){
	$query = "INSERT INTO link(uid, url) 
		        VALUES ('".SQLite3::escapeString($_POST['uid'])."', '".SQLite3::escapeString($_POST['url'])."')";
	$results = $base->exec($query);
	echo $results;
}
else die("nope");


?>



