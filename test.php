<?php require 'phpfix/core.php';
# -- DB Info --
//Database Host
$dbh='localhost';
//Database Name
$dbn='t';
//Database User
$dbu='root';
//Database Password
$dbp='root';
# -- Database
$conn=mysqli_connect($dbh,$dbu,$dbp,$dbn);
if($err=mysqli_error($conn)){
    err($err);
}