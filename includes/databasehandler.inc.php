<?php

// $serverName = "sql204.epizy.com";
// $dBUserName = "epiz_32174162";
// $dBPassword = "2Tei7mrLv3";
// $dBName = "epiz_32174162_ntadb01";

$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "ntadb01";

$conn = mysqli_connect($serverName, 
                        $dBUserName, 
                        $dBPassword, 
                        $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
