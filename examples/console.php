<?php
/**
 * Example of how to use Searcher Crawler as CLI
 */

$input = readline("Insert upto 5 keywords: ");
preg_match("/^(\w+(\s){0,1}){1,5}/",$input,$search);
$search = $search[0];

require __DIR__."/../api/Searcher.php";
$api = new Searcher($search);

$content = $api->run();
file_put_contents("./out.json",$content);

?>