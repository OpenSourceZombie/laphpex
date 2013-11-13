<?php
require("frontgit.php");
//send names of the html input to the constructor
$texToPDF=new laphpex("result","mahh_title","mahh_content","mahh_error");
$texToPDF->build();
?>
