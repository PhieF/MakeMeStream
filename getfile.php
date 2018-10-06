<?php
    if(!empty($_GET['url'])){
        $url = $_GET['url'];
        if(strpos($url, 'videos/embed') !== false && strpos($url, 'https://')===0){
            $file = file_get_contents($url);
        }
    }

?>