<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWD', 'mysqlpasswd');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'dbname');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWD, DB_NAME) OR die ('Could not connect to MySql: ' . mysqli_connect_error() );
mysqli_set_charset($dbc, 'utf8');

