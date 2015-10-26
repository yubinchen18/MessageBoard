<?php
//Includes
include_once "header.php";
include_once "message.class.php";
include_once "database.class.php";

/***************************************************************************
                            Initialization
 *              Modify SQL Database server login info here
***************************************************************************/
include_once "dbconnection.php";
error_reporting(E_ALL);
?>
<!--***************************************************************************
                   FORM -uses POST/REDIRECT/GET- 
***************************************************************************-->
<div class="container-fluid" style="width:40%; float:center">
    <h1>Message Board</h1>
    <form role="form" method="post" action="validate.php">
        <div class="form-group <?php echo !empty($_GET['nameError']) ? "has-error has-feedback": "";?>">
            <label for="name">Naam: </label>
            <!--Field required error message-->
            <small class="text-warning"><?php echo !empty($_GET['nameError']) ? "*".$_GET['nameError']: "";?></small>
            <input type="text" class="form-control" id="name" name="name" placeholder="Voer hier je naam in (30 tekenss max.)">
            <?php echo !empty($_GET['nameError']) ? "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>": "";?>
        </div>
        <div class="form-group <?php echo !empty($_GET['contentError']) ? "has-error has-feedback": "";?>">
            <label for="message">Bericht:</label>
            <!--Field required error message-->
            <small class="text-warning"><?php echo !empty($_GET['contentError']) ? "*".$_GET['contentError']: "";?></small>
            <textarea class="form-control" rows="6" id="content" name="content" placeholder="Voeg hier een bericht toe...  (300 tekens max.)"></textarea>
            <?php echo !empty($_GET['contentError']) ? "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>": "";?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="submit" value="submit"><span class="glyphicon glyphicon-send"></span> Plaatsen</button>
            <button type="submit" class="btn btn-danger" name="submit" value="cancel"><span class="glyphicon glyphicon-remove"></span> Annuleer</button>  
        </div>
        <!--captcha tag-->
        <div class="g-recaptcha" data-sitekey="6LftlA8TAAAAACVdLpI7GKGZ4y63Q_R5srsARrde"></div>
    </form>
    <div>
        <h2>Berichten</h2>
        <?php
/***************************************************************************
                         Instantiate database
***************************************************************************/
        $db = new Database($servername,$dbname,$username,$password);
        $db->connect();
        $db->getAllMessages();
        $db->printMessages();
        ?>       
    </div>
</div>

    
<?php
include_once "footer.php";
?>