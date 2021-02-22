<?php
foreach ($_COOKIE as $key => $value) {
	echo "<br>nombre: $key";
	print_r($value);
}