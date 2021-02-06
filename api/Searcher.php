<?php
class Searcher{
    private $url = "";
    
    function __construct($search){
        $search = urlencode($search);
        $this->url = "https://www.google.com/search?q=$search";
    }

    function run(){
        define("banned",array_map("trim",explode("\n",file_get_contents("./banned.txt"))));
        $html = $this->call($this->url);
        
        preg_match_all('/<div class="g".*?>(.*?)<\/div>/',$html,$out);
        $out = $out[0];
        
        // Gets the titles
        $titles = array_map(
            function($elem) {
                preg_match('/(<h3 class="LC20lb DKV0Md".*?>)\K(.*?)(?=<\/h3>)/', $elem, $match);
                return $match[0];
            }
        , $out);
        
        // Gets the links
        $links = array_map(
            function($elem) {
                preg_match('/(href=.*?")\K(.*?)(?=")/', $elem, $match);
                return $match[0];
            }
        , $out);
        
        
        // Gets sites from results
        $sitesHTML = array_map(
            function($link) {
                return $this->call($link);
            }
        , $links);
        
        // Removes invisible tags
        $sitesContent = array_map(function($elem){
            $elem = trim(preg_replace('/\r+|\n+|\s+|\t+/', " ", $elem));
            /*$elem = preg_replace('/<head.*?>(.*?)<\/head>/',"", $elem);*/
            $elem = preg_replace('/<script.*?>(.*?)<\/script>/',"", $elem);
            $elem = preg_replace('/<style.*?>(.*?)<\/style>/',"", $elem);
            return strip_tags($elem);
        }, $sitesHTML);
        
        
        // Gets all the words and
        $keywords = array_map(function($html){
            $allWords = explode(" ", $html);
        
            $counts = array_count_values($allWords);
            
            $words = array_keys($counts);
            $counts = array_values($counts);
        
            $result = [];
            for ($i=0; $i < count($words); $i++) { 
                $word = $words[$i];
                $count = $counts[$i];
        
                if(preg_match("/[a-zA-ZÁ-ú]/",$word) && !preg_match("/\n|\s|\r/",$word) && $word != "" && $word != null){
                    $insensitive = strtolower(preg_replace("/,/","",$word));
                    if(!in_array($insensitive, banned) && !in_array($insensitive,$result)){
                        array_push($result, [
                            "count" => $count,
                            "word" => $word
                        ]);
                    }
                }
            }
            return $result;
        }, $sitesContent);
        
        // Sorts the array
        $keywords = array_map(function($key){
            usort($key, function($a, $b) {
                return $b['count'] - $a['count'];
            });
        
            $key = array_slice($key,0 ,20);
            return $key;
        },$keywords);
        
        // Gets all the H1 and H2 tags
        $hTags = array_map(
            function($html) {
                
                preg_match_all('/(<h1.*?>)\K(.*?)(?=<\/h1>)/', $html, $h1);
                preg_match_all('/(<h2.*?>)\K(.*?)(?=<\/h2>)/', $html, $h2);

                $hs = [
                    "1" => array_map("strip_tags",$h1[0]),
                    "2" => array_map("strip_tags",$h2[0])
                ];

                return $hs;
            }
        , $sitesHTML);

        // Gets all the a tags
        $aTags = array_map(
            function($html) {
                
                preg_match_all('/(<a.*?>)\K(.*?)(?=<\/a>)/', $html, $a);

                $a = strip_tags($a[0]);

                return $a;
            }
        , $sitesHTML);
        
        $result = array_map(function($title,$link,$h,$keywords){
            return array(
                "title" => $title,
                "link" => $link,
                "site" => [
                    "h1" => $h["1"],
                    "h2" => $h["2"],
                    "keywords" => $keywords
                ]
            );
        }, $titles, $links, $hTags, $keywords);
        
        $result = json_encode($result,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        return $result;
    }

    protected function call($url){
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => "$url",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
        ));
        
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}
?>