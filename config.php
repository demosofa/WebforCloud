<?php
$host = 'ec2-54-87-34-201.compute-1.amazonaws.com';
$dbname = 'd7drsbv5bd202n';
$user_db = 'epcqrbjgylnpjk';
$pw_db = '0ea10e0dd21c9abc5ef0106d7729dd684732a35faa5c850198558e4e2866bbd6';

$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user_db password=$pw_db");
if (!$conn) {
die("Connection failed: ".pg_connect_error());
}
?>
