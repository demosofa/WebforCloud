<?php
define('USER', 'epcqrbjgylnpjk');
define('PASSWORD', '0ea10e0dd21c9abc5ef0106d7729dd684732a35faa5c850198558e4e2866bbd6');
define('HOST', 'ec2-54-87-34-201.compute-1.amazonaws.com');
define('DATABASE', 'd7drsbv5bd202n');
try {
    $connection = new PDO("pgsql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
