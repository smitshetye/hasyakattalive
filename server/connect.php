<?php

$servername = 'sql106.byetcluster.com';
$database = 'epiz_27694097_live';
$username = 'epiz_27694097';
$password = 'c4nyN5xqg5q4';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die('');
}
