<?php
//includes
include_once "database.class.php";

/***************************************************************************
                         Setup database connection 
 *              Modify SQL Database server login info here
***************************************************************************/
include_once "dbconnection.php";
$db = new Database($servername,$dbname,$username,$password);
$db->connect();

/***************************************************************************
 *              Put form data into database
 *          Performing empty field check, datatype check,
 *          htmlspecialchars check, replace " " with "&nbsp"
 *          nl2br, trim, strip slashes, max character, 
 *                   (maybe more later)
 ***************************************************************************/
// define error variables and set to empty values
$nameError = $contentError = "";

if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit']))
{
    if ($_POST['submit']=="submit") {
        if (empty($_POST['name'])) {    
            $nameError = "Naam is vereist";
        } else {
            if (is_string($_POST['name'])) {
                if (strlen($_POST['name']) > 30) {
                    $nameError = "Max. 30 karacters";
                } else {
                    $name = $db->filterData($_POST['name']);
                }
            } else {
                $nameError = "Datatype error";
            }
        }
        
        if (empty($_POST['content'])) {
            $contentError = "Bericht is leeg";
        } else {
            if (is_string($_POST['content'])) {
                if (strlen($_POST['content']) > 300) {
                    $contentError = "Max. 300 karacters";
                } else {
                    $content = $db->filterData($_POST['content']);
                }
            } else {
                $contentError = "Datatype error";
            }
        }
        //Whenever there are errors, back to form with errors using &_GET
        if ($nameError !== "" OR $contentError !== "") {
            header("location: index.php?nameError=$nameError&contentError=$contentError");
            exit();
            
        //If both fields filled en error free, format data and send to database
        /***************************************************************************
        *               Prepared statement (Parameterized Queries) used
        *               for SQL injection prevention etc...
        *               !!Further security improvements needed in the future!!
        *                   
        *                      but it works so far
        ***************************************************************************/
        } elseif (!empty($_POST['name']) && !empty($_POST['content']) && ($nameError = $contentError == "")) {
            $db->insertIntoDB($name, $content);
            header("location: index.php");
            exit();
        }     
    }
    elseif ($_POST['submit']=="cancel")
    {
        header("location: index.php");
        exit();
    }
}