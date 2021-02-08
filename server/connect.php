<?php

$servername = 'ec2-52-22-161-59.compute-1.amazonaws.com';
$database = 'd5ifgimakiqcre';
$username = 'zuctybtoaeumqy';
$password = '2c174edee7f46e0fc78a09fa4de7556887da8aa158ad6f7a5c542bfe14bd17e2';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die('');
}
