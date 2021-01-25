<?php
$nasa =json_decode(file_get_contents("https://api.nasa.gov/planetary/apod?api_key=sk1mKvLicboTTuGP8kDFIXa0V9Ay1nO0cTCa5zi1"));
$tabla="<table style='border: solid black 1px'>";
foreach ($nasa as $key => $value) {
$tabla.="<tr> <td>$key</td> ";
$tabla.="</tr>";
}
$tabla.="</table>";
echo $tabla;