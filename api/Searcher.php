<?php
/**
 * The crawler that makes everything possible :D
 */
class Searcher{
    private $search = "";
    private $date = "";
    private $url = "";
    
    /**
     * 
     * @param String $search The string to search
     */
    function __construct($search){
        if($search == "" || $search == null) throw new Exception("Search argument cannot be empty", 1);

        $this->search = $search;
        $search = urlencode($search);
        $this->url = "https://www.google.com/search?q=$search";
        $this->date = date("d-M-Y H:i:s");
    }

    /**
     * Runs the crawler
     */
    function run(){
        define("banned",array_map("trim",explode("\n",file_get_contents("./banned.txt"))));
        $html = $this->call($this->url);
        
        preg_match_all('/<div class="g".*?>(.*?)<\/div>/',$html,$out);
        $out = $out[0];
        
        // Gets the titles
        $titles = array_map(
            function($elem) {
                preg_match('/(<h3 class="LC20lb DKV0Md".*?>)\K(.*?)(?=<\/h3>)/', $elem, $match);
                return strip_tags($match[0]);
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
        $sitesContent = array_map(function($html){
            $html = trim(preg_replace('/\r+|\n+|\s+|\t+/', " ", $html));
            $html = preg_replace('/<script.*?>(.*?)<\/script>/',"", $html);
            $html = preg_replace('/<style.*?>(.*?)<\/style>/',"", $html);
            $html = strip_tags($html);
            return $html;
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
                
                preg_match_all('/(<a.*?href=")\K(.*?)(?=")/', $html, $a);

                $a = array_map("strip_tags",$a[0]);
                
                return $a;
            }
        , $sitesHTML);
        
        // Gets OG images
        $images = array_map(
            function($html) {
                preg_match('/("og:image".*?content=")\K(.*?)(?=")/', $html, $img);
                return $img[0];
            }
        , $sitesHTML);
        
        $result = array_map(function($title,$link,$h,$a,$keyword,$img){
            return array(
                "title" => $title,
                "link" => $link,
                "img" => $img,
                "site" => [
                    "h1" => $h["1"],
                    "h2" => $h["2"],
                    "a" => array_values(array_unique($a)),
                    "keywords" => $keyword
                ]
            );
        }, $titles, $links, $hTags,$aTags ,$keywords, $images);
        
        $result = [
            "search" => $this->search,
            "date" => $this->date,
            "sites" => $result
        ];
        
        $result = json_encode($result,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        return $result;
    }

    /**
     * Gets the content of an URL
     * 
     * @param String $url The url to get the content
     */
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