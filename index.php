<?php require __DIR__."/lang/lang.php"; ?>
<!DOCTYPE html>
<html lang="<?=LANG?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?=LOCALE["seo:description"]?>">

    <meta property="og:url" content="https://vsmarket.herokuapp.com/">
    <meta property="og:image" content="https://vsmarket.herokuapp.com/assets/bg.jpg">
    <meta property="og:title" content="<?=LOCALE["seo:title"]?>">
    <meta property="og:description" content="<?=LOCALE["seo:description"]?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?=LOCALE["seo:locale"]?>">
    <meta property="fb:app_id" content="751620599111843">

    <meta name="twitter:card" content="summary">
    <meta property="twitter:title" content="<?=LOCALE["seo:title"]?>">
    <meta property="twitter:description" content="<?=LOCALE["seo:description"]?>">
    <meta name="twitter:image" content="https://vsmarket.herokuapp.com/assets/bg.jpg">

    <!--Indexing-->
    <meta name="google-site-verification" content="-AQCEvMjRRv522zctToOjHu-AOCF6yp8Hju9E2W0TuA" />
    <meta name="yandex-verification" content="106e4fc1ac2b2221" />
    <meta name="msvalidate.01" content="021824C8E71C8BF772EDDC91FEFC09A8" />
    <meta name="facebook-domain-verification" content="7f6jtu66hymk0cqhvxgajllnmfxabg" />

    <link rel="shortcut icon" href="./assets/logo.svg" type="image/x-icon">
    <link rel="canonical" href="https://vsmarket.herokuapp.com/">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <title><?=LOCALE["seo:title"]?></title>
</head>
<body class="m-0;p-0;break-words">
    <header class="relative z-20 grid grid-cols-2 p-5 bg-white max-h-24">
        <a href="/" class="cursor-pointer">
            <img src="./assets/logo.svg" class="inline-block max-h-16" style="-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;" alt="Logo VS Market" class="text-center">
            <label class="text-2xl font-bold text-gray-700 cursor-pointer">Vs Market</label>
        </a>
        <nav class="w-full my-auto text-right rounded outline-none">
                <form action="" method="get">
                    <select name="lang" id="lang" class="px-4 py-3 bg-gray-100" onchange="this.form.submit();">
                        <option value="en" <?php if(LANG == "en") echo("selected")?>>(EN) English</option>
                        mdi
                        <option value="es" <?php if(LANG == "es") echo("selected")?>>(ES) Español</option>
                    </select>
                </form>
        </nav>
    </header>
    <main>
        <div id="loading" class="fixed z-10 hidden w-full bottom-2">
            <p class="px-4 py-3 mx-auto text-center text-white bg-indigo-600 rounded max-w-full-md"><?=LOCALE["searchbar:popup"]?></p>
        </div>
        <section class="relative flex items-center justify-center w-full mb-10 overflow-hidden bg-purple-900 max-h-96 py-72">
            <form action="./api/get" class="z-10 inline-block w-full pb-24 text-center text-white" method="get" id="searchForm">
                <h1 class="mb-5 text-4xl font-bold" style=" text-shadow: 0px 0px 5px rgba(0, 0, 0,0.3);"><?=LOCALE["searchbar:title"]?></h1>
                <p class="mb-5 text-xl" style=" text-shadow: 0px 0px 2px rgba(0, 0, 0,0.5);"><?=LOCALE["searchbar:subtitle"]?></p>
                <input type="text" name="s" class="w-full p-3 mb-2 text-gray-600 rounded outline-none md:max-w-md md:mb-0" placeholder="<?=LOCALE["searchbar:placeholder"]?>" pattern="^([A-zÁ-ú]+(\s){0,1}){1,5}" title="<?=LOCALE["searchbar:instruction"]?>" required>
                <input type="text" name="email" id="email">
                <button class="block w-full px-5 py-3 font-bold text-center text-white align-top transition-colors bg-purple-600 rounded outline-none md:w-auto md:inline hover:bg-purple-500" type="submit"><span class="mdi mdi-magnify"></span></button>
            </form>
            <p class="absolute z-10 italic text-white animate-pulse bottom-24 lg:bottom-56" id="flavor"><?=LOCALE["searchbar:flavor"]?></p>
            <a href="https://www.freepik.es/wirestock" class="absolute bottom-0 z-10 px-3 py-2 text-white underline transition-opacity bg-black rounded-t opacity-50 right-1 text-s bg-opacity-30 hover:opacity-100">Wirestock</a>
            <img src="./assets/bg.jpg" class="absolute bottom-0 left-0 z-0 w-screen h-full m-0" style="-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;" alt="Foto por rawpixel.com">
        </section>
        <section class="min-h-screen p-10 mb-16 bg-white lg:p-20">
            <div class="block mb-5 text-center">
                <h2 class="mb-5 text-4xl font-bold text-gray-700"><?=LOCALE["about:title"]?></h2>
                <hr class="max-w-md mx-auto border-2 border-purple-600 border-solid">
            </div>
            <div class="block text-center lg:flex lg: lg:items-center">
                <img class="inline-block" src="./assets/about.svg" alt="">
                <div class="lg:ml-10">
                    <p class="text-justify text-gray-600">
                        <?=LOCALE["about:body"]?>
                    </p>
                </div>
            </div>
        </section>
        <section class="p-20 bg-gray-100 lg:flex lg:p-32 lg:items-center">
            <div class="container">
                <h2 class="mb-5 text-gray-700 text-7xl"><?=LOCALE["github:title"]?></h2>
                <p class="mb-7"><?=LOCALE["github:body"]?></p>
                <pre class="p-3 break-all whitespace-pre-wrap bg-gray-200 rounded-2xl">git clone https://github.com/LuanHimmlisch/vsmarket.git</pre>
            </div>
            <a href="https://github.com/LuanHimmlisch/vsmarket" class="text-gray-700 transition-colors text-9xl hover:text-purple-800 lg:mr-32 lg:ml-52" target="_blank"><span class="block text-center mdi mdi-github lg:inline"></span></a>
        </section>
    </main>
    <footer class="p-20 text-center text-white bg-gray-700">
        <p><?=LOCALE["footer:credits"]?></p>
        <p><?=LOCALE["footer:more"]?></p>
    </footer>
    <script defer>
        const submit = document.getElementById("searchForm");
        submit.addEventListener("submit",()=>{
           const popup = document.getElementById("loading");
           if(popup.classList.contains("hidden")) popup.classList.remove("hidden");
        });
    </script>
    <style>
        #email{
            position: absolute;
            left: -99999px;
            top: -99999px;
        }
        #loading{
            animation-name: loading;
            animation-iteration-count: infinite;
            animation-duration: 3s;
            opacity: 0;
        }
        @keyframes loading {
            0%{
                opacity: 0;
            }
            45%{
                opacity: 1;
            }
            55%{
                opacity: 1;
            }
            100%{
                opacity: 0;
            }
        }
    </style>
</body>
</html>