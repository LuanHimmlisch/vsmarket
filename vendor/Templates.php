<?php
class T {
    
    static public function searchCard(
        $id,
        $title,
        $link,
        $image,
        $description,
        $h1s,
        $h2s,
        $keywords,
        $backlinks
    ){
        $emojis = [
            "&#x1F947;",
            "&#x1F948;",
            "&#x1F949;",
            "&#x2714;","&#x2714;","&#x2714;","&#x2714;","&#x2714;","&#x2714;","&#x2714;",
            "&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;","&#x274C;"
        ];



        $content = "
        <article class='max-w-full p-5 mb-6 break-words bg-white rounded shadow'>
            <div class='grid grid-cols-2'>
                <div class=''>
                    <h2 class='text-xl font-bold'>$title</h2>
                    <a href='$link' target='_blank' class='text-lg underline'>$link</a>
                    <p class='mt-2'>$description</p>
                    <h3 class='mt-3 text-lg font-bold'>H1(s) tag(s):</h3>
                    <ul class='pl-5 list-disc'>";

        foreach ($h1s as $h1) {
            $content .= "<li>$h1</li>";
        }

        $content .= "
                    </ul>
                    <h3 class='mt-3 text-lg font-bold'>H2(s) tag(s):</h3>
                    <ul class='pl-5 mb-5 list-disc'>";
        
        foreach ($h2s as $h2) {
            $content .= "<li>$h2</li>";
        }

        $content .= "
                    </ul>
                </div>
                <img class='max-w-full max-h-full ml-auto border-8 border-purple-400' src='$image' alt='$title'>
            </div>
            <div class='extra'>
                <button class='px-5 py-3 text-white transition-colors bg-purple-500 rounded' onclick='extra($id,this)'>Show more</button>
                <section class='hidden transition-all' id='extra-$id'>
                    <hr class='max-w-md my-5 border-gray-300 border-solid border-1'>
                    <div class=''>
                        <h3 class='mb-6 text-3xl font-bold'>Keywords:</h3>";
        
        for ($i=0; $i < count($keywords); $i++) { 
            $keyword = $keywords[$i];
            $count = $keyword["count"];
            $word = $keyword["word"];
            $emoji = "";
            if($i<count($emojis)) $emoji = $emojis[$i];
            
            $content .= "
            <div class='grid items-center block max-w-full grid-cols-3 p-5 mb-3 text-center transition-transform bg-gray-100 rounded'>
                <h4 class='text-4xl'>$emoji ".($i+1)."°</h4><h5 class='text-3xl font-bold'>$word</h5> <p><b>$count</b> veces</p>
            </div>
            ";
        }

        $content .= "
                    </div>
                    <hr class='max-w-md my-5 border-gray-300 border-solid border-1'>
                    <div class=''>
                        <h3 class='mb-6 text-3xl font-bold'>Backlinks:</h3>
                        <p class='text-gray-500'>&#x26a0; <i>We are not responsable for the content of the links</i></p>
                        <ul class='pl-5 my-5 list-disc'>";
        
                        foreach ($backlinks as $backlink) {
                            $content .= "<li>$backlink</li>";
                        }
                
                        $content .= "
                        </ul>
                    </div>
                </section>
            </div>
        </article>
        ";

        return $content;
    }

}
?>