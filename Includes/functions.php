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

function countryName($db, $id)
{
    $country_query = $db->query("SELECT country_name FROM countries WHERE countryID = '$id' limit 1")->fetch_object()->country_name;
    echo '<td>' . $country_query . '</td>';
}

//Display Permission Name based on ID

function groupName($db, $id)
{
    $group_query = $db->query("SELECT permissionName FROM group_permissions WHERE permissionID = '$id' limit 1")->fetch_object()->permissionName;
    echo '<td>' . $group_query . '</td>';
}


//Check if group is in use (I.E are any users apart of this group)
function groupInUse($db, $id, $type)
{
    $user_query = $db->query("SELECT groupID FROM users WHERE groupID = '$id' limit 1");
    $count = mysqli_num_rows($user_query);
    if ($type = "Row") {
        if ($count == 0) {
            echo '<td><a href ="#" onclick="deleteGroup('.$id.')" >Delete</a></td>';

        } else {
            echo '<td> [Unavailable] </td>';
        }
    } elseif ($type = "Check") {
        if ($count == 0) {
            return true;

        } else {
            return false;
        }
    } else {
        return false;
    }

}

//Check if group is in use (I.E are any users apart of this group)
function permissionInUse($db, $id, $type)
{
    $group_query = $db->query("SELECT `permissionID` FROM `group` WHERE permissionID = '$id'");
    $count = mysqli_num_rows($group_query);
    if ($type = "Row") {
        if ($count == 0) {
            echo '<td><a href ="#" onclick="deletePerm('.$id.')" >Delete</a></td>';

        } else {
            echo '<td> [Unavailable] </td>';
        }
    } elseif ($type = "Check") {
        if ($count == 0) {
            return true;

        } else {
            return false;
        }
    } else {
        return false;
    }
}

//Check if two users are the same
function userMatch($user1, $user2)
{
    $check = isEqual($user1, $user2);

    if(!$check)
    {
        echo '<td><a href ="#" onclick="deleteUser('.$user1.')">Delete</a></td>';
    }
    else if($check)
    {
        echo '<td> [Unavailable] </td>';
    }

}
?>