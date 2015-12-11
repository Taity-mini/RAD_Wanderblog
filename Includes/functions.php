<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (15046930)
 * Date: 09/12/2015
 * Time: 00:08
 * Functions Class for WanderBlog
 */


//Form Validation Functions
    // Check if two variables are equal (I.E Does field 1 match field 2
    function isEqual($Field1, $Field2)
    {
        if ($Field1 === $Field2) {
            return true;
        } else {
            return false;
        }
    }


//Admin Panel Functions
    //Display Country Name based on ID

    function countryName($db,$id)
    {
        $country_query =$db->query("SELECT country_name FROM countries WHERE countryID = '$id' limit 1")->fetch_object()->country_name;
        echo '<td>'.$country_query.'</td>';
    }

?>