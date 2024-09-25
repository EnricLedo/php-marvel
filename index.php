<?php

const API_URL = "https://whenisthenextmcufilm.com/api";

$ch = curl_init(API_URL);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactiva verificación SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Desactiva verificación del host

$result = curl_exec($ch);

if ($result === false) {
    $error = curl_error($ch);
    $error_no = curl_errno($ch);
    echo "cURL Error: ($error_no) $error";
} else {
    $data = json_decode($result, true);
}

curl_close($ch);

?>

<head>
    <title>La próxima película de Marvel</title>
    <meta name="description" content="Descubre cuál es la próxima película de Marvel"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
</head>

<main>
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?>"
        style="border-radius: 10px;"
        />
    </section>

    <hgroup>
        <h2><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h2>
        <p> Fecha de estreno: <?= $data["release_date"]; ?></p>
        <p>La siguiente es: <?= $data["following_production"]["title"] ?></p>
    </hgroup>
    
</main>

<style>
    :root{
        color-scheme: light dark;
    }

    body{
        display: grid;
        place-content: center;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;

    }

    img{
        margin: 0 auto;
    }
</style>