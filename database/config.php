<?php

$host = "localhost";
$db_name = "basicbank";
$username = "root";
$password = "";

//mysqli_connect(host_name,username,password,database_name)
$con = mysqli_connect($host,$username,$password,$db_name);

if($con->connect_error)
{
    die('connection failed'.$con->connect_error);
}else{

}

?>