
<?php

$paises = array('País','Capital','Extensión','Habitantes');
$alemania = array('Alemania','Berlín','557046','78420000');
$austria = array('Austria','Viena','83849','7614000');
$belgica = array('Bélgica','Bruselas','30518','993200');

echo "<table border ='1'>";

    verPais($paises);
    verPais($alemania);
    verPais($austria);
    verPais($belgica);

echo "</table>";



function verPais($pais){
    echo "<tr>";
    foreach($pais as $value){
        echo "<td> $value </td>";
    }
    echo "</tr>";
}
?>