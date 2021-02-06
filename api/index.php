<?php
require "./Searcher.php";
$api = new Searcher($_POST["s"]);

echo($api->run());

?>