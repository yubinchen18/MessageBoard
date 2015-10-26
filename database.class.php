<?php

class Database
{
    private $_servername;
    private $_dbname;
    private $_username;
    private $_password;
    private $_messages = array();
    public  $connection;
    
    /***************************************************************************
                    SQL Server login info needed on construct
    ***************************************************************************/
    public function __construct($servername, $dbname, $username, $password)
    {
        $this->_servername  = $servername;
        $this->_dbname      = $dbname;
        $this->_username    = $username;
        $this->_password    = $password;
    }
    
    /***************************************************************************
                               Connect to SQL Database
    ***************************************************************************/
    public function connect()
    {
        try 
        {
            $this->connection = new PDO("mysql:host=$this->_servername;dbname=$this->_dbname", $this->_username, $this->_password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'connected';
        }
            catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    /***************************************************************************
    *              Put form data into database using
    *          Prepared statement (Parameterized Queries)
    *          for SQL injection prevention etc...
    *       !!Further security improvements needed in the future!!
    *                   
    *                      but it works so far
    ***************************************************************************/
    public function insertIntoDB($name, $content)
    {
        $date       = "DATE_FORMAT(NOW(),'%d-%m-%Y')";
        $time       = "DATE_FORMAT(NOW(),'%H:%i:%s')";
        $datetime   = "DATE_FORMAT(NOW(),'%e-%m-%Y %H:%i:%s')";
            
        $parameters = array(':name'     => $name,
                            ':content'  => $content);
        
        try
            {
                $sql = "INSERT INTO messages (name, content, date, time, datetime) 
                        VALUES (:name, :content, $date, $time, $datetime)";
                
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($parameters);
                
                // The exec method returns number of row affected by the query
                $affectedRows = $stmt->rowCount();
                // The lastInsertId method gets the new record id you've just inserted
                $insertId = $this->connection->lastInsertId();
                
                // Test codes
                //echo "affected rows: ".$affectedRows."<br>";
                //echo $insertId;
            }
                catch (PDOException $ex) 
            {
                echo "Submit Failed: " . $ex->getMessage();
            }
    }
    
    /******************************************************
    *    Get all messages from mysql database when called
    *              
    *              only works after connect()
    ******************************************************/
    public function getAllMessages()
    {
        try
        {    
            //Query statement
            $sql = "SELECT * FROM messages order by datetime DESC";
            $result = $this->connection->query($sql, PDO::FETCH_ASSOC);
            foreach ($result as $row)
            {
                //Instantiate new Message and store them in $messages
                $message = new Message($row['name'], $row['content'], $row['date'], $row['time']);
                $this->_messages[] = $message;
            }
            
        } 
        catch (PDOException $ex) 
        {
            echo "Failed to get messages from database: " . $ex->getMessage();
        }
    }
    
    /******************************************************
    *              
    *        Print all messages in table format
    *             
    ******************************************************/
    public function printMessages()
    {
    /******************************************************              
    *      Message output style can be modified here             
    ******************************************************/    
        echo "<table class='table table-borderless' style='table-layout: fixed; word-wrap:break-word'>";
        
        foreach ($this->_messages as $message)
        {    
            $print = "<tr style='border-top-width:1px;border-top-style: ridge;border-top-color:#DADADA'>
                        <th>".$message->get_name()."</th>
                        <td style='text-align:right'><small class='text-info'>".$message->get_date()." om ".$message->get_time()."</small></td>
                      </tr>
                      <tr>
                        <td colspan='2'>".$message->get_content()."</td>
                      </tr>";
            echo $print;
        }    
        echo "</table>";
    }
    
    /***************************************************************************
    *          Filter data with htmlspecialchars check, 
    *          replace " " with "&nbsp", nl2br, trim, 
    ***************************************************************************/
    public function filterData($data) 
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = str_replace(" ", "&nbsp", $data);
        $data = nl2br($data);
        return $data;
    }
    
    public function addToBoard($message)
    {
        if (count($this->_messages)==0)
            $this->_messages[] = $message; 
        else {
            array_unshift($this->_messages, $message);
        }
    }
    
    public function info(){
        print_r($this->_messages);
        echo count($this->_messages); 
    }
    
    function set_servername($_servername) {
        $this->_servername = $_servername;
    }

    function set_dbname($_dbname) {
        $this->_dbname = $_dbname;
    }

    function set_username($_username) {
        $this->_username = $_username;
    }

    function set_password($_password) {
        $this->_password = $_password;
    }
}
?>