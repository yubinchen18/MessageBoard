<?php
include "header.php";
include_once "message.class.php";
/*********************************************************
 *              this file test codes
 ********************************************************/
//include_once "dbconnection.php";
/*
$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
$next_page = "index.php"."<br>";

echo "<script>window.location = 'http://' . $server_dir . $next_page'</script>";

//$db = null;
//header('Location: http://www.youtube.com');
//header("Location: localhost:8888/phpproject1/MessageBoard/index.php"); /* Redirect browser */
//exit;
/*echo "<pre>pohpaoieg \n \n pfoihpaegh \n poiea \r</pre>";
echo "<br>";
echo nl2br("pohpaoieg \n \n pfoihpaegh \n poiea \r");
echo "<br>";
print_r($_POST);
//echo $name = $db->quote($_POST['content']);
echo "<br>";
echo nl2br($_POST['name']);
echo "<br>";

$name       = $db->quote("wtf");
        $content    = $db->quote("homo");
        $date       = "DATE_FORMAT(NOW(),'%e-%m-%Y')";
        $time       = "DATE_FORMAT(NOW(),'%k:%i:%s')";
        $datetime   = "DATE_FORMAT(NOW(),'%e-%m-%Y %k:%i:%s')";
        
            $sql = "INSERT INTO messages (name, content, date, time, datetime) 
                    VALUES (
                                " . $name . ",
                                " . $content . ", 
                                " . $date . ",
                                " . $time . ",
                                " . $datetime . "
                            )";
            echo $sql;

$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
echo $server_dir."<br>";
echo $_SERVER['HTTP_HOST']."<br>";
echo dirname($_SERVER['PHP_SELF'])."<br>";
echo rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."<br>";
echo 'Location: http://' . $server_dir . $next_page;
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
    <input type="textarea" name="test">
    <input type="submit">
</form>
<form role="form" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="form-group <?php echo !empty($_GET['nameError']) ? "has-error has-feedback": "";?>">
            <label for="name">Naam: </label>
            <!--Field required error message-->
            <small class="text-warning"><?php echo !empty($_GET['nameError']) ? "*".$_GET['nameError']: "";?></small>
            <input type="text" class="form-control" id="name" name="name" placeholder="Voer hier je naam in">
            <?php echo !empty($_GET['nameError']) ? "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>": "";?>
        </div>
        <div class="form-group <?php echo !empty($_GET['contentError']) ? "has-error has-feedback": "";?>">
            <label for="message">Bericht:</label>
            <!--Field required error message-->
            <small class="text-warning"><?php echo !empty($_GET['contentError']) ? "*".$_GET['contentError']: "";?></small>
            <textarea class="form-control" rows="6" id="content" name="content" placeholder="Voer hier je bericht in"></textarea>
            <?php echo !empty($_GET['contentError']) ? "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>": "";?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="submit" value="submit"><span class="glyphicon glyphicon-send"></span> Plaatsen</button>
            <button type="submit" class="btn btn-danger" name="submit" value="cancel"><span class="glyphicon glyphicon-remove"></span> Annuleer</button>  
        </div>
    </form>
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);         
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "database.class.php";
error_reporting(E_ALL);
$db = new Database("localhost","message_board","root","root");
        $db->connect();
        
        //$db->getAllMessages();
        
        //print_r($db->get_messages());
        //$db->printMessages();

//echo $db->_username;

$name = "testingphpase";
$content = "testingphase";

$date       = "DATE_FORMAT(NOW(),'%d-%m-%Y')";
            $time       = "DATE_FORMAT(NOW(),'%H:%i:%s')";
            $datetime   = "DATE_FORMAT(NOW(),'%e-%m-%Y %H:%i:%s')";
            
            $parameters = array(':name'     => $name,
                                ':content'  => $content);
                                
            try
            {
                $sql = "INSERT INTO messages (name, content, date, time, datetime) 
                        VALUES (:name, :content, $date, $time, $datetime)";
                
                $stmt = $db->connection->prepare($sql);
                $stmt->execute($parameters);
                
                // The exec method returns number of row affected by the query
                $affectedRows = $stmt->rowCount();
                // The lastInsertId method gets the new record id you've just inserted
                $insertId = $db->connection->lastInsertId();
                
                // Test codes
                //echo "affected rows: ".$affectedRows."<br>";
                //echo $insertId;
                header("location: index.php");
                exit();
            }
                catch (PDOException $ex) 
            {
                echo "Submit Failed: " . $ex->getMessage();
            }
?>