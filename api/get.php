<?php
if(!isset($_GET["s"]) 
|| $_GET["s"] == "" 
|| $_GET["s"] == null){
    header("location: /");
    exit();
}

preg_match("/^([A-zÁ-ú]+(\s){0,1}){1,5}/",$_GET["s"],$search);
define("search", $search[0]);
define("path",__DIR__."/../cache/".search.".json");

function expired(){
    require "./Searcher.php";
    $api = new Searcher(search);
    
    $content = $api->run();

    file_put_contents(path,$content);

    return $content;
}

if(file_exists(path)){
    $fileTime = filemtime(path);
    if($fileTime != false && time() - $fileTime > 30*60){
        $content = expired();
    }else{
        $content = file_get_contents(path);
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