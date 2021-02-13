<?php
if(!isset($_GET["s"]) 
|| !empty($_GET["email"])
|| $_GET["s"] == "" 
|| $_GET["s"] == null){
    header("location: /");
    exit();
}
require __DIR__."/../lang/lang.php";

preg_match("/^([A-zÁ-ú]+(\s){0,1}){1,5}/",$_GET["s"],$search);
define("SEARCH", $search[0]);
define("PATH",__DIR__."/../cache/".LANG." - ".SEARCH.".json");

CONST MINUTES = 60;

function expired(){
    require "./Searcher.php";
    $api = new Searcher(SEARCH,[
        "Accept-Language: ".LANG,
    ]);
    
    $content = $api->run();
    
    if($content != null && $content != "") file_put_contents(PATH,$content);

    return $content;
}

if(file_exists(PATH)){
    $fileTime = filemtime(PATH);
    if($fileTime != false && time() - $fileTime > MINUTES*60){
        $content = expired();
    }else{
        $content = file_get_contents(PATH);
    }
}else{
    $content = expired();
}

session_start(); 

$_SESSION["search_result"] = json_decode($content,true);
header("location: /result");
exit();
?>
<a href="/result">Redirigiendo...</a>