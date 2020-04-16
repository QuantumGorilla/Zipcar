<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=autos', 'root', '');
}
catch (Exception $e)
{ die('Error: ' . $e->getMessage()); }
?>