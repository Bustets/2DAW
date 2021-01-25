<?php
$nasa =json_decode(file_get_contents("https://api.nasa.gov/planetary/apod?api_key=sk1mKvLicboTTuGP8kDFIXa0V9Ay1nO0cTCa5zi1"), true);
//var_dump($nasa);

    echo "Titulo:".$nasa['title']." <br>";
    echo "<img src='".$nasa['url']."'> <br>";
