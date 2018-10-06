<?php

$dbname='base';
if(!class_exists('SQLite3'))
  die("SQLite 3 NOT supported. Please install it <br />sudo apt-get install php5-sqlite3<br />sudo systemctl restart apache2");



$uid = substr(uniqid(),-4);
?>


<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, height=device-height,initial-scale=1.0">
		<title>Make me stream</title>
        <script src="jquery-3.3.1.min.js"></script>
		 
	</head>
	<body>
		<style>
        html, body{
            padding:0px;
            margin:0px;
        }
        body{
            background: url("kde.png");
        }
			#box{
                padding:40px;
                margin:auto;
                color: white;
                height: calc(100%-40px);
                background:rgba(0, 0, 0, 0.70);
                text-align:center;
                max-height: 500px;
            }
            #iframe{
                padding:0px;
                margin:0px;
                display:none; 
                position:absolute; 
                top:0; 
                left:0;
                height:100%; 
                width:100%;
            }
            #uid-div{
                font-size:40px;
                transition-timing-function: ease;
                transition-delay: 2s;
                transition: font-size 0.7s; /* transition is set to 'font-size 12s' */

            }
 
            
		</style>
		<script>
		
var get = function () {
    $.ajax({
        url: "getlink.php?uid="+currentId,
        type: "GET",
        success: function (data) {
            console.log(data)
            if(data.length>0){
                if(data[0].url != undefined){
                    //document.getElementById('iframe').contentWindow.document.getElementsByClassName('vjs-big-play-button').click()
                    iframe.src=data[0].url;
                    iframe.style.display="inline";
                    iframe.onload= function() {
                     $(iframe).contents().find(".vjs-play-control").click();
                    }
                }
            }

        },
        fail: function () {
            console.log("fail");
        },
        error: function (e) {
            console.log("error " + e);
        
        }
    });
}

var post = function () {
    var url = $("#url").val().replace("/videos/watch/","/videos/embed/");
    $.ajax({
        url: "sendlink.php",
        data: {
            uid:$("#uid").val(),
            url:url+(url.indexOf("?")>=0?"&":"?")+"autoplay=1",
        },
        type: "POST",
        success: function (data) {
            console.log("success")
        },
        fail: function () {
            console.log("post failure");
        },
        error: function (e) {
            console.log("post error " + e);
        }
    });
}


var phpUid = "<?php echo $uid; ?>";
var currentId = localStorage.getItem("uid");
console.log(currentId);
if(currentId == undefined){
    currentId = phpUid;
    localStorage.setItem("uid", currentId);
}
		</script>
		<div id="box">
        <h1>Make me stream</h3>
            <h3>Enter TV UID and the URL to stream</h3>
            <form>
                <input type="text" id="uid" placeholder="Enter UID"/>
                <input type="text" id="url"  placeholder="Enter URL"/>
                <input type="submit" onclick="post(); return false;" />
            </form>
            <h3>Or make me stream !</h3>
            <div id="uid-div">UID : <span id="uid-to-stream"></span></div>


		</div>
      
        <iframe frameBorder="0" sandbox="allow-same-origin allow-scripts"  autoplay id="iframe" allowfullscreen ></iframe> 
        <script>
            var iframe = document.getElementById("iframe");
            $("#uid-to-stream").html(currentId);
            setInterval(get, 1000)
            setTimeout(function(){document.getElementById("uid-div").style.fontSize="80px";},1000);
        </script>
	</body>
</html>






