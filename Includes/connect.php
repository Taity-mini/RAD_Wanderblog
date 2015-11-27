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

$db = new mysqli(
    "eu-cdbr-azure-north-d.cloudapp.net", //db host
    "b49912ac2cf930", //username
    "e632d092", //pw
    "RGU_1504693"  //db_name

);

if(!$db) {
    die('Connect Error:' .mysqli_connect_errno());
}