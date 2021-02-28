<?php

$conn = pg_connect("host=ec2-54-87-34-201.compute-1.amazonaws.com port=5432 dbname=d7drsbv5bd202n user=epcqrbjgylnpjk password=0ea10e0dd21c9abc5ef0106d7729dd684732a35faa5c850198558e4e2866bbd6");
if (!$conn) {
die("Connection failed: ".pg_connect_error());
}
?>
