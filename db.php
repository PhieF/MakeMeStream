<?php
$dbname='base';
if(!class_exists('SQLite3'))
  die("SQLite 3 NOT supported. Please install it <br />sudo apt-get install php5-sqlite3<br />sudo systemctl restart apache2");
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('data.db');
    }
}
$base=new MyDB();

$query = "CREATE TABLE IF NOT EXISTS link(
	    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            uid text,
            url text)";
            
$results = $base->exec($query);
?>
