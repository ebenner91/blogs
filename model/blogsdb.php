<?php
/*
*Elizabeth Benner
*5/21/17
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
        } catch (PDOException $e) {
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
        $insert = 'INSERT INTO bloggers (image_path, blog_count, bio, username, password, last_post, email)
        VALUES (:image_path, :blog_count, :bio, :username, :password, :last_post, :email)';
        
        $statement = $this->_pdo->prepare($insert);

        $statement->bindValue(':image_path', $blogger->getPath(), PDO::PARAM_STR);
        $statement->bindValue(':blog_count', 0, PDO::PARAM_INT); //blog count starts at zero, new bloggers have no posts
        $statement->bindValue(':bio', $blogger->getBio(), PDO::PARAM_STR);
        $statement->bindValue(':username', $blogger->getUsername(), PDO::PARAM_STR);
        $statement->bindValue(':password', $blogger->getPass(), PDO::PARAM_STR);
        $statement->bindValue(':last_post', $blogger->getLatestPost(), PDO::PARAM_STR);
        $statement->bindValue(':email', $blogger->getEmail(), PDO::PARAM_STR);
        
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
        SET blog_count = blog_count + 1
        WHERE id=:id';
        
        $statement = $this->_pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();
    }
    
    /**
     *Decrements blogger's blog count
     *
     *@param int id the id number of the blogger whose count is being decremented
     */
    function reduceCount($id)
    {
        $update = 'UPDATE bloggers
        SET blog_count = blog_count - 1
        WHERE id=:id';
        
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
       $select = 'SELECT id, username, image_path, blog_count, bio, last_post
                    FROM bloggers WHERE id=:id';
       
       //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':id', $id, PDO::PARAM_INT);
       $statement->execute();
       
       //return the array holding the info pulled from the database 
       return $statement->fetch(PDO::FETCH_ASSOC);
   }
   
   /**
    *Checks user credentials
    *
    *@param String username the username entered
    *@param String password the password entered
    *
    *@return boolean indiating whether the credentials matched
    */
   function login($username, $password)
   {
        $select = 'SELECT username, password
                    FROM bloggers WHERE username=:username';
                    
        //prepare the statement and bind the id
        $statement = $this->_pdo->prepare($select);
        $statement->bindValue(':username', $username, PDO::PARAM_INT);
        $statement->execute();
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return password_verify($password, $result['password']);
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
       $select = 'SELECT id, username, image_path, blog_count, bio, last_post
                    FROM bloggers ORDER BY username';
       $statement = $this->_pdo->prepare($select);
        
       $statement->execute();
        
       $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
       return $results;
   }
   
   /**
    *Updates a user's password
    *
    *@param String password the new password to be entered
    *@param int id the id of the user to be updates
    */
   function changePassword($password, $id)
   {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $update = 'UPDATE bloggers
        SET password = :password
        WHERE id = :id';
        
        $statement = $this->_pdo->prepare($update);
        $statement->bindValue(':password', $password, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();
        
   }
   
   /**
    *Retrieves a blogger by their username
    *
    *@param String username the username of the blogger to be retrieved
    */
   function getBloggerByUsername($username)
   {
        $select = 'SELECT id, username
                    FROM bloggers WHERE username=:username';
                    
        //prepare the statement and bind the id
        $statement = $this->_pdo->prepare($select);
        $statement->bindValue(':username', $username, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
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
    function addPost($blogPost)
    {
        
        $insert = 'INSERT INTO blogposts (blogger_id, title, blog_post, word_count, post_date)
        VALUES (:blogger_id, :title, :blog_post, :word_count, now())';
        
        $statement = $this->_pdo->prepare($insert);
        
        $statement->bindValue(':blogger_id', $blogPost->getBloggerId(), PDO::PARAM_INT);
        $statement->bindValue(':title', $blogPost->getTitle(), PDO::PARAM_STR);
        $statement->bindValue(':blog_post', $blogPost->getText(), PDO::PARAM_STR);
        $statement->bindValue(':word_count', $blogPost->getWordCount(), PDO::PARAM_INT);

        $statement->execute();
        
        //Return ID of inserted row
        return $this->_pdo->lastInsertId();
        
    }
    
    /**
     *Deletes a post from a user's blog
     *
     *@param int id the id of the blog post to be deleted
     */
    function deletePost($id)
    {
        $delete = 'DELETE FROM blogposts
        WHERE id = :id';
        
        $statement = $this->_pdo->prepare($delete);
        
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        $statement->execute();
    }
    
    /**
     *Updates a post on a user's blog
     *
     *@param int id the id of the post to be updated
     *@param BlogPost blogPost the BlogPost object containing the new blog post data
     */
    function updatePost($id, $blogPost)
    {
        
        $update = 'UPDATE blogposts
        SET title = :title, blog_post = :blog_post, word_count = :word_count,
        post_date = now()
        WHERE id = :id';
        
        $statement = $this->_pdo->prepare($update);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', $blogPost->getTitle(), PDO::PARAM_STR);
        $statement->bindValue(':blog_post', $blogPost->getText(), PDO::PARAM_STR);
        $statement->bindValue(':word_count', $blogPost->getWordCount(), PDO::PARAM_INT);
        
        $statement->execute();
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
       $select = 'SELECT id, blogger_id, title, blog_post, word_count, post_date
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
       $select = 'SELECT id, title, blog_post, word_count, post_date
                    FROM blogposts WHERE blogger_id=:blogger_id  ORDER BY post_date DESC';
       
       //prepare the statement and bind the id
       $statement = $this->_pdo->prepare($select);
       $statement->bindValue(':blogger_id', $bloggerId, PDO::PARAM_INT);
       $statement->execute();
       
       //return the array holding the info pulled from the database 
       return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   
   /**
    *Gets the most recent post by timestamp in the database
    *
    *@param int id the id of the user whose posts are being pulled from
    */
   function getMostRecent($id)
   {
        $select = 'SELECT id, post_date
                    FROM blogposts WHERE blogger_id=:blogger_id ORDER BY post_date DESC';
       
        //prepare the statement and bind the id
        $statement = $this->_pdo->prepare($select);
        $statement->bindValue(':blogger_id', $id, PDO::PARAM_INT);
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
        $statement->bindValue(':id', $postId, PDO::PARAM_INT);
        $statement->execute();
        
        //retrieve the data
        $postData = $statement->fetch(PDO::FETCH_ASSOC);
        
        //retrieve the post text
        $text = $postData['blog_post'];
        
        //cut post text to a snippet
        $text = substr($text, 0, 300)."...";
        
        //get blogger's id
        $bloggerId = $postData['blogger_id'];
        
        $update = 'UPDATE bloggers
         SET last_post = :last_post
         WHERE id = :id';
         
         $statement = $this->_pdo->prepare($update);
         $statement->bindValue(':last_post', $text, PDO::PARAM_STR);
         $statement->bindValue(':id', $bloggerId, PDO::PARAM_INT);
         
         $statement->execute();
        
        
   }
   
   /**
    *Gets the data for the blogger associated with a post
    *
    *@param int postId the id of the blog post
    *
    *@return an associative array containing the blogger's data
    */
   function getBloggerByPost($postId)
   {
        //Create the select statement
        $select = 'SELECT blogger_id
                    FROM blogposts WHERE id=:id';
       
        //prepare the statement and bind the id
        $statement = $this->_pdo->prepare($select);
        $statement->bindValue(':id', $postId, PDO::PARAM_INT);
        $statement->execute();
        
        $post = $statement->fetch(PDO::FETCH_ASSOC);
        
        $bloggerId = $post['blogger_id'];
     
         //Create the select statement
         $select = 'SELECT id, username, image_path, blog_count, bio, last_post
                     FROM bloggers WHERE id=:id';
        
        //prepare the statement and bind the id
        $statement = $this->_pdo->prepare($select);
        $statement->bindValue(':id', $bloggerId, PDO::PARAM_INT);
        $statement->execute();
        
        //return the array holding the info pulled from the database 
        return $statement->fetch(PDO::FETCH_ASSOC);
   }
}