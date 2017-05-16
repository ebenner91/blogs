<?php
/*
*Elizabeth Benner
*5/16/17
*blogsdb.php
*This class provides access to the blog database for the blogs website
*/

/**
 * Provides CRUD access to blog information in the database
 *
 * PHP Version 5
 *
 * @author Elizabeth Benner
 * @version 1.0
 */

/*
  CREATE TABLE bloggers (
  id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(50),
  lname VARCHAR(50),
  imagepath VARCHAR(255),
  blogcount INT(3)
  );
*/

//Connect to the database (re-using code written by Josh Archer and edited in class with guidance from Tina Ostrander)
class BlogsDB
{
    private $_pdo;
    
    /**
     *Constructor to open the connection to the database
    */
    function __construct()
    {
        //Require configuration file
        require_once '/home/ebenner/config.php';
        
        try {
            //Establish database connection
            $this->_pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            
            //Keep the connection open for reuse to improve performance
            $this->_pdo->setAttribute( PDO::ATTR_PERSISTENT, true);
            
            //Throw an exception whenever a database error occurs
            $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e) {
            die( "Error!: " . $e->getMessage());
        }
    }
    
}