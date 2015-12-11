<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 *
 * Description: Connect to Database Script
 * 
 */
//Live azure server
//$db = new mysqli(
//    "eu-cdbr-azure-north-d.cloudapp.net", //db host
//    "b49912ac2cf930", //username
//    "e632d092", //pw
//    "RGU_1504693"  //db_name
//);

//Localhost dev server

$db = new mysqli(
    "localhost", //db host
    "root", //username
    "", //pw
    "Wanderblog"  //db_name

);



/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* check if server is alive */
if (mysqli_ping($db)) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", mysqli_error($db));
}