<?php

function getTopHeadlinesSources($apiKey) {
    // URL de la API
    $url = 'https://newsapi.org/v2/top-headlines/sources?apiKey=' . $apiKey;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'MiAplicacion'); 
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error al obtener datos de la API: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);
    $data = json_decode($response, true);
    
    return $data;
}

function getRandomUser() {
    // URL de la API RandomUser
    $url = 'https://randomuser.me/api/';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        echo 'Error al obtener datos de la API: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);
    $data = json_decode($response, true);

    return $data['results'][0]; 
}

?>
