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
    
    //Blogger access methods
    
    /**
     *Method to add a blogger to the bloggers table
     * @access public
     * @param Object blogger takes a Blogger object containing the data to be added to the database
     *
     * @return id number of the entry
     */
    function addBlogger($blogger)
    {
        
        //Create the insert statement, setting the premium column to 1 to indicate a premium member
        $insert = 'INSERT INTO bloggers (fname, lname, image_path, blog_count, bio, username, password)
        VALUES (:fname, :lname, :image_path, :blog_count, :bio, :username, :password)';
        
        $statement = $this->_pdo->prepare($insert);
        
        $statement->bindValue(':fname', $blogger->getFName(), PDO::PARAM_STR);
        $statement->bindValue(':lname', $blogger->getLName(), PDO::PARAM_STR);
        $statement->bindValue(':image_path', $blogger->getPath(), PDO::PARAM_STR);
        $statement->bindValue(':blog_count', 0, PDO::PARAM_INT); //blog count starts at zero, new bloggers have no posts
        $statement->bindValue(':bio', $blogger->getBio(), PDO::PARAM_STR);
        $statement->bindValue(':username', $blogger->getUsername(), PDO::PARAM_STR);
        $statement->bindValue(':password', $blogger->getPass(), PDO::PARAM_STR);
        
        $statement->execute();
        
        //Return ID of inserted row
        return $this->_pdo->lastInsertId();
        
    }
    
    /**
     * Increments a blogger's blog count
     *
     * @param int id the id number of the blogger whose count is being incremented
     */
    function updateCount($id)
    {
        $update = 'UPDATE bloggers
        SET blog_count = blogCount + 1
        WHERE id-:id';
        
        $statement = $this->_pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();
    }
    
    /**
    * Returns a blogger that matches the given id
    *
    * @access public
    * @param int $id the id of the blogger
    *
    * @return an associative array of blogger information, or false if
    * the member was not found
    */
   function getBloggerById($id)
   {
        //Create the select statement
       $select = 'SELECT id, fname, lname, image_path, blog_count, bio
                    FROM bloggers WHERE id=:id';
       
       //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':id', $id, PDO::PARAM_INT);
       $statement->execute();
       
       //return the array holding the info pulled from the database 
       return $statement->fetch(PDO::FETCH_ASSOC);
   }
   
   /**
    * Returns all bloggers in the database collection.
    *
    * @access public
    *
    * @return an associative array of bloggers ordered by last name
    */
   function allBloggers()
   {
       $select = 'SELECT id, fname, lname, image_path, blog_count, bio
                    FROM bloggers ORDER BY lname';
       $statement = $this->_pdo->prepare($select);
        
       $statement->execute();
        
       $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
       return $results;
   }
   
   //End Blogger access methods, begin Blog Post access methods
   
   /**
     *Method to add a blog post to the blogpost table
     * @access public
     * @param Object blogPost takes a BlogPost object containing the data to be added to the database
     * @param int bloggerId takes the id number of the blogger who entered the post
     *
     * @return id number of the entry
     */
    function addPost($blogPost, $bloggerId)
    {
        
        //Create the insert statement, setting the premium column to 1 to indicate a premium member
        $insert = 'INSERT INTO blogposts (blogger_id, blog_post, word_count, post_date)
        VALUES (:blogger_id, :blog_post, :word_count, now())';
        
        $statement = $this->_pdo->prepare($insert);
        
        $statement->bindValue(':blogger_id', $bloggerId, PDO::PARAM_INT);
        $statement->bindValue(':blog_post', $blogPost->getPost(), PDO::PARAM_STR);
        $statement->bindValue(':word_count', $blogPost->getCount(), PDO::PARAM_INT);

        $statement->execute();
        
        //Return ID of inserted row
        return $this->_pdo->lastInsertId();
        
    }
    
    /**
    * Returns a blog post that matches the given id
    *
    * @access public
    * @param int $id the id of the blog post
    *
    * @return an associative array of blog post information, or false if
    * the post was not found
    */
   function getPostById($id)
   {
        //Create the select statement
       $select = 'SELECT id, blogger_id, blog_post, word_count, post_date
                    FROM blogposts WHERE id=:id';
       
       //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':id', $id, PDO::PARAM_INT);
       $statement->execute();
       
       //return the array holding the info pulled from the database 
       return $statement->fetch(PDO::FETCH_ASSOC);
   }
   
   /**
    * Returns all posts made by a given blogger
    *
    * @access public
    * @param int $bloggerId the id of the blogger
    *
    * @return an associative array of all posts by the blogger, ordered by post date, or false if
    * the blogger id was not found
    */
   function getAllPostsByBlogger($bloggerId)
   {
        //Create the select statement
       $select = 'SELECT id, blogger_id, blog_post, word_count, post_date
                    FROM blogposts WHERE blogger_id=:blogger_id  ORDER BY post_date';
       
       //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':id', $id, PDO::PARAM_INT);
       $statement->execute();
       
       //return the array holding the info pulled from the database 
       return $statement->fetch(PDO::FETCH_ASSOC);
   }
   
   /**
    * Update's a blogger's "latest post" excerpt
    *
    * @access public
    * @param int postId takes the id number of the post to be excerpted
    */
   function updateLatestPost($postId)
   {
        //get the latest post from the blogs database
        $select = 'SELECT blogger_id, blog_post
                    FROM blogposts WHERE id=:id';
        
        //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':id', $id, PDO::PARAM_INT);
       $statement->execute();
       
       //retrieve the data
       $postData = $statement->fetch(PDO::FETCH_ASSOC);
       
       //retrieve the post text
       $text = $postData['blog_post'];
       
       //cut post text to a snippet
       $text = substr($text, 0, 140)."...";
       
       //get blogger's id
       $bloggerId = $postData['blogger_id'];
       
       $update = 'UPDATE bloggers
        SET last_post = :last_post
        WHERE id-:id';
        
        $statement = $this->_pdo->prepare($update);
        $statement->bindValue(':last_post', $text, PDO::PARAM_STR);
        $statement->bindValue(':id', $bloggerId, PDO::PARAM_INT);
        
        $statement->execute();
        
        
   }
}