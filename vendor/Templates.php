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
        <article class='max-w-full bg-white shadow p-5 rounded mb-6'>
            <div class='grid grid-cols-2'>
                <div class=''>
                    <h2 class='text-xl font-bold'>$title</h2>
                    <a href='$link' target='_blank' class='underline text-lg'>$link</a>
                    <p class='mt-2'>$description</p>
                    <h3 class='text-lg font-bold mt-3'>Etiqueta(s) H1(s):</h3>
                    <ul class='list-disc pl-5'>";

        foreach ($h1s as $h1) {
            $content .= "<li>$h1</li>";
        }

        $content .= "
                    </ul>
                    <h3 class='text-lg font-bold mt-3'>Etiqueta(s) H2(s):</h3>
                    <ul class='list-disc pl-5 mb-5'>";
        
        foreach ($h2s as $h2) {
            $content .= "<li>$h2</li>";
        }

        $content .= "
                    </ul>
                </div>
                <img class='max-h-full max-w-full border-8 border-purple-400 ml-auto' src='$image' alt='$title'>
            </div>
            <div class='extra'>
                <button class='text-white px-5 py-3 rounded bg-purple-500 transition-colors' onclick='extra($id,this)'>Mostrar</button>
                <section class='transition-all hidden' id='extra-$id'>
                    <hr class='max-w-md border-1 border-gray-300 border-solid my-5'>
                    <div class=''>
                        <h3 class='text-3xl font-bold mb-6'>Keywords:</h3>";
        
        for ($i=0; $i < count($keywords); $i++) { 
            $keyword = $keywords[$i];
            $count = $keyword["count"];
            $word = $keyword["word"];
            $emoji = "";
            if($i<count($emojis)) $emoji = $emojis[$i];
            
            $content .= "
            <div class='max-w-full bg-gray-100 p-5 rounded mb-3 grid grid-cols-3 transition-transform block text-center items-center'>
                <h4 class='text-4xl'>$emoji ".($i+1)."°</h4><h5 class='text-3xl font-bold'>$word</h5> <p><b>$count</b> veces</p>
            </div>
            ";
        }

        $content .= "
                    </div>
                    <hr class='max-w-md border-1 border-gray-300 border-solid my-5'>
                    <div class=''>
                        <h3 class='text-3xl font-bold mb-6'>Backlinks:</h3>
                        <p class='text-gray-500'>&#x26a0; <i>No nos hacemos responsables del contenido de los links</i></p>
                        <ul class='list-disc pl-5 my-5'>";
        
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