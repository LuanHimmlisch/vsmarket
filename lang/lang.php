<?php
$locale = [
    'es' =>[
        'seo:title' => 'Vs Market - Analizador SEO de competencia',
        'seo:locale' => 'es_MX',
        'seo:description' => 'Obtén y analiza las keywords SEO de tu competencia. Mejora tu SEO ahora',
        'searchbar:title' => 'Analiza el SEO de tus competidores',
        'searchbar:subtitle' => 'Obtén las palabras claves de las páginas más <i>exitosas</i>&#128293;',
        'searchbar:placeholder' => 'Busca hasta 5 keywords...',
        'searchbar:instruction' => 'Hasta 5 palabras sin caracteres especiales',
        'searchbar:flavor' => 'Prueba con <b>"Agencia desarrollo web"</b>',
        'searchbar:popup' => 'Obteniendo información, esto puede tardar un tiempo. Espera por favor...',
        'about:title' => '¿Cómo funciona?',
        'about:body' => 'VS Market es una herramienta <strong>SEO</strong> que utiliza un <i>Web Scraper</i> programado en PHP.
                        Un Web Scraper es un script/bot que ha sido diseñado para enviar solicitudes a sitios web. 
                        De toda la información obtenida, la filtra, separa y organiza para su futuro <strong>análisis</strong>.
                        <br><br>
                        Motores de búsqueda como Google, Bing o Yandex funcionan de manera similar usando bots conocidos como
                        <i>Web crawlers</i> o <i>Spiders</i>. Estos bots aparte de recopilar información, navegan los links encontrados.
                        Empiezan con una sola página y se extienden a todas las demás, creando una telaraña de información.
                        <br><br>
                        El web scraper de VS Market te da a conocer información de las páginas más <strong>exitosas</strong> de Google.
                        Está información la puedes utilizar para mejorar el éxito de tu propio sitio web.
                        <b>Inserta hasta 5 palabras clave por las que quisieras ser encontrado en Google</b>.',
        'github:title' => '¡Colabora!',
        'github:body' => 'VS Market es un proyecto Open Source creado por <a href="https://luanhimmlisch.github.io/" target="_blank" class="underline">Luan Himmlisch</a> en vanilla PHP bajo la licencia <a href="./LICENSE" class="font-bold underline">GNU V3</a>.
                        ¿Tienes ideas de cómo mejorar el proyecto? <a href="https://github.com/LuanHimmlisch/vsmarket" target="_blank" class="underline">¡Inicia un pull request!</a>',
        'footer:credits' => 'Vs Market por <a href="https://luanhimmlisch.github.io/" target="_blank" class="underline">Luan Himmlisch</a>. Proyecto bajo licencia <a href="./LICENSE" class="font-bold underline">GNU V3</a>',
        'footer:more' => 'Servicios web en <a href="https://himmlischweb.tk" target="_blank" class="underline">Himmlisch web</a>.'
    ],
    'en' => [
        'seo:title' => 'Vs Market - SEO Rival Analyzer',
        'seo:locale' => 'en_US',
        'seo:description' => 'Get and analyze the SEO keywords of your rivals. Improve your SEO now!',
        'searchbar:title' => 'Analize the SEO of your rivals',
        'searchbar:subtitle' => 'Get the keywords of the most successful <i>websites</i>&#128293;',
        'searchbar:placeholder' => 'Search up to 5 keywords...',
        'searchbar:instruction' => 'Up to 5 words without special characters',
        'searchbar:flavor' => 'Try <b>"Web development agency"</b>',
        'searchbar:popup' => 'Gathering data, this could took a while. Please wait...',
        'about:title' => 'How it works?',
        'about:body' => 'VS Market es una herramienta <strong>SEO</strong> que utiliza un <i>Web Scraper</i> programado en PHP.
                        Un Web Scraper es un script/bot que ha sido diseñado para enviar solicitudes a sitios web. 
                        De toda la información obtenida, la filtra, separa y organiza para su futuro <strong>análisis</strong>.
                        <br><br>
                        Motores de búsqueda como Google, Bing o Yandex funcionan de manera similar usando bots conocidos como
                        <i>Web crawlers</i> o <i>Spiders</i>. Estos bots aparte de recopilar información, navegan los links encontrados.
                        Empiezan con una sola página y se extienden a todas las demás, creando una telaraña de información.
                        <br><br>
                        El web scraper de VS Market te da a conocer información de las páginas más <strong>exitosas</strong> de Google.
                        Está información la puedes utilizar para mejorar el éxito de tu propio sitio web.
                        <b>Inserta hasta 5 palabras clave por las que quisieras ser encontrado en Google</b>.',
        'github:title' => 'Colaborate!',
        'github:body' => 'VS Market is an Open Source project made by <a href="https://luanhimmlisch.github.io/" target="_blank" class="underline">Luan Himmlisch</a> with vanilla PHP under the <a href="./LICENSE" class="font-bold underline">GNU V3</a> license.
                        You have an idea for the project? <a href="https://github.com/LuanHimmlisch/vsmarket" target="_blank" class="underline">Start a pull request!</a>',
        'footer:credits' => 'Vs Market made by <a href="https://luanhimmlisch.github.io/" target="_blank" class="underline">Luan Himmlisch</a>. Under the license <a href="./LICENSE" class="font-bold underline">GNU V3</a>',
        'footer:more' => 'Web services on <a href="https://himmlischweb.tk" target="_blank" class="underline">Himmlisch web</a>.'
    ]
];
session_start();
$_SESSION["lang"] = $_GET['lang'] ?? $_SESSION["lang"] ?? null;
$lang = $_SESSION["lang"] ?? 'en';
if(!isset($locale[$lang])) $lang = 'en';


define("LANG", $lang);
define("LOCALE", $locale[LANG]);

unset($lang);
?>