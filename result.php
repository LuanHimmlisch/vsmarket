<?php
    session_start(); 
    if(!isset($_SESSION["search_result"])){
        header("location: /");
        exit();
    }
    $sites = $_SESSION["search_result"];
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta property="og:url" content="https://">
    <meta property="og:image" content="https://">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="fb:app_id" content="">

    <meta name="twitter:card" content="summary">
    <meta property="twitter:title" content="">
    <meta property="twitter:description" content="">
    <meta name="twitter:image" content="https://">

    <link rel="shortcut icon" href="./assets/logo.svg" type="image/x-icon">
    <link rel="canonical" href="https://">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <title>VS Market - Resultados de competencia</title>
</head>
<body class="bg-purple-100">
    <header class="bg-white max-h-24 py-4 relative z-20 block mb-10">
        <a href="/" class="cursor-pointer">
            <img src="./assets/logo.svg" class="h-16 inline-block ml-5" style="-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;" alt="Logo VS Market" class="text-center">
            <label class="font-bold text-gray-700 text-2xl cursor-pointer">Vs Market</label>
        </a>
        <nav class="w-full p-5">

        </nav>
    </header>
    <main class="container mx-auto px-20">
        <h1 class="text-5xl mt-10 mb-2">Resultados de busqueda "<?=$sites["search"]?>"</h1>
        <p class="mb-10 italic text-gray-500">Consulta almacenada el <?=$sites["date"]?></p>
        <?php
        require __DIR__."/vendor/Templates.php";
        $id = 0;
        foreach ($sites["sites"] as $site) {
            $id++;
            $img = $site["img"] ?? "./assets/notfound.jpg";

            echo T::searchCard(
                $id,
                $site["title"],
                $site["link"],
                $img,
                "",
                $site["site"]["h1"],
                $site["site"]["h2"],
                $site["site"]["keywords"],
                $site["site"]["a"]
            );
        }
        
        ?>
    </main>

    <script>
        function extra(num,button){
            const elem = document.querySelector("#extra-"+num);
            if(elem == null) return;

            if(elem.classList.contains("hidden")){
                elem.classList.remove("hidden");
                button.classList.remove("bg-purple-500");
                button.classList.add("bg-blue-300");
                button.innerHTML = "Ocultar";
            }else{
                elem.classList.add("hidden");
                button.classList.remove("bg-blue-300");
                button.classList.add("bg-purple-500");
                button.innerHTML = "Mostrar";
            }
        }
    </script>
</body>
</html>